import * as THREE from '../../vendor/assets/libs/three125/three.module.js';
import { GLTFLoader } from '../../vendor/assets/libs/three/jsm/GLTFLoader.js';
import { RGBELoader } from '../../vendor/assets/libs/three/jsm/RGBELoader.js';
import { ARButton } from '../../vendor/assets/ARButton.js';
import { LoadingBar } from '../../vendor/assets/LoadingBar.js';

class App{
	constructor(){
		const container = document.createElement( 'div' ); // Membuat elemen 'div' baru untuk menampung aplikasi
		document.body.appendChild( container ); // Menambahkan 'div' yang baru dibuat ke dalam body dokumen

        this.loadingBar = new LoadingBar(); // Membuat instance dari kelas LoadingBar untuk menampilkan progress bar
        this.loadingBar.visible = false; // Menyembunyikan loading bar secara default

		this.assetsPath = '../../vendor/dokumentasi/'; // Menetapkan path aset untuk dokumentasi
        
		this.camera = new THREE.PerspectiveCamera( 70, window.innerWidth / window.innerHeight, 0.01, 20 ); // Membuat kamera perspektif
		this.camera.position.set( 0, 1.6, 0 ); // Mengatur posisi awal kamera
        
		this.scene = new THREE.Scene(); // Membuat scene baru

		const ambient = new THREE.HemisphereLight(0xffffff, 0xbbbbff, 1); // Membuat pencahayaan ambient
        ambient.position.set( 0.5, 1, 0.25 ); // Mengatur posisi pencahayaan
		this.scene.add(ambient); // Menambahkan pencahayaan ke dalam scene
			
		this.renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true } ); // Membuat renderer WebGL dengan anti-aliasing dan transparansi
		this.renderer.setPixelRatio( window.devicePixelRatio ); // Mengatur pixel ratio renderer
		this.renderer.setSize( window.innerWidth, window.innerHeight ); // Mengatur ukuran renderer sesuai dengan ukuran jendela
        this.renderer.outputEncoding = THREE.sRGBEncoding; // Mengatur output encoding renderer
		// container.appendChild( this.renderer.domElement ); // Menambahkan elemen canvas renderer ke dalam container
        this.setEnvironment(); // Memanggil fungsi untuk mengatur environment
        
        this.reticle = new THREE.Mesh(
            new THREE.RingBufferGeometry( 0.15, 0.2, 32 ).rotateX( - Math.PI / 2 ),
            new THREE.MeshBasicMaterial()
        ); // Membuat objek reticle sebagai indikator hit test
        
        this.reticle.matrixAutoUpdate = false; // Menonaktifkan auto-update matrix reticle
        this.reticle.visible = false; // Menyembunyikan reticle secara default
        this.scene.add( this.reticle ); // Menambahkan reticle ke dalam scene
        
        this.setupXR(); // Memanggil fungsi untuk mengatur XR
		
		window.addEventListener('resize', this.resize.bind(this) ); // Menambahkan event listener untuk menangani perubahan ukuran jendela
	}
    
    setupXR(){
        this.renderer.xr.enabled = true; // Mengaktifkan XR pada renderer
        
        if ( 'xr' in navigator ) {
            // Memeriksa apakah XR didukung oleh perangkat
			navigator.xr.isSessionSupported( 'immersive-ar' ).then( ( supported ) => {
                // Jika AR didukung, tampilkan tombol AR
                if (supported){
                    const collection = document.getElementsByClassName("ar-button");
                    [...collection].forEach( el => {
                        el.style.display = 'block';
                    });
                }
			} );
		} 
        
        const self = this;

        this.hitTestSourceRequested = false; // Menandakan bahwa hit test source belum diminta
        this.hitTestSource = null; // Inisialisasi hit test source dengan null
        
        function onSelect() {
            if (self.chair===undefined) return;
            // Jika chair tidak didefinisikan, keluar dari fungsi
            
            if (self.reticle.visible){
                self.chair.position.setFromMatrixPosition( self.reticle.matrix ); // Mengatur posisi chair sesuai dengan posisi reticle
                self.chair.visible = true; // Menampilkan chair
            }
        }

        this.controller = this.renderer.xr.getController( 0 ); // Mendapatkan XR controller
        this.controller.addEventListener( 'select', onSelect ); // Menambahkan event listener untuk select event pada controller
        
        this.scene.add( this.controller ); // Menambahkan controller ke dalam scene
    }
	
    resize(){
        this.camera.aspect = window.innerWidth / window.innerHeight; // Mengatur aspek rasio kamera
    	this.camera.updateProjectionMatrix(); // Memperbarui matriks proyeksi kamera
    	this.renderer.setSize( window.innerWidth, window.innerHeight ); // Mengatur ukuran renderer sesuai dengan ukuran jendela
    }
    
    setEnvironment(){
        const loader = new RGBELoader().setDataType( THREE.UnsignedByteType ); // Membuat loader untuk file HDR
        const pmremGenerator = new THREE.PMREMGenerator( this.renderer ); // Membuat PMREMGenerator untuk environment map
        pmremGenerator.compileEquirectangularShader(); // Mengkompilasi shader equirectangular
        
        const self = this;
        
        loader.load( '../../vendor/assets/hdr/venice_sunset_1k.hdr', ( texture ) => {
          const envMap = pmremGenerator.fromEquirectangular( texture ).texture; // Membuat environment map dari texture HDR
          pmremGenerator.dispose(); // Membebaskan memori yang digunakan oleh PMREMGenerator

          self.scene.environment = envMap; // Mengatur environment scene

        }, undefined, (err)=>{
            console.error( 'An error occurred setting the environment'); // Menangani error jika terjadi
        } );
    }
    
	showChair(id){
        this.initAR(); // Memulai sesi AR
        
		const loader = new GLTFLoader( ).setPath(this.assetsPath); // Membuat GLTFLoader dengan path aset
        const self = this;
        
        this.loadingBar.visible = true; // Menampilkan loading bar
		
		// Load a glTF resource
		loader.load(
			// resource URL
			id, // ID dari model GLTF yang akan di-load
			// called when the resource is loaded
			function ( gltf ) {
				self.scene.add( gltf.scene ); // Menambahkan model GLTF ke dalam scene
                self.chair = gltf.scene; // Menyimpan referensi model ke dalam properti chair
        
                self.chair.visible = false; // Menyembunyikan chair secara default
                
                self.loadingBar.visible = false; // Menyembunyikan loading bar
                
                self.renderer.setAnimationLoop( self.render.bind(self) ); // Mengatur animasi loop untuk renderer
			},
			// called while loading is progressing
			function ( xhr ) {
				self.loadingBar.progress = (xhr.loaded / xhr.total); // Mengatur progress loading bar
			},
			// called when loading has errors
			function ( error ) {
				console.log( 'An error happened' ); // Menangani error jika terjadi
			}
		);
	}			
    // =====================
    initAR(){
        let currentSession = null; // Inisialisasi sesi AR saat ini dengan null
        const self = this;
        
        const sessionInit = { requiredFeatures: [ 'hit-test' ] }; // Menetapkan fitur yang diperlukan untuk sesi AR
        
        function onSessionStarted( session ) {
            session.addEventListener( 'end', onSessionEnded ); // Menambahkan event listener untuk sesi berakhir

            self.renderer.xr.setReferenceSpaceType( 'local' ); // Mengatur tipe ruang referensi XR
            self.renderer.xr.setSession( session ); // Mengatur sesi XR pada renderer
       
            currentSession = session; // Menyimpan referensi sesi saat ini
            
        }

        function onSessionEnded( ) {
            currentSession.removeEventListener( 'end', onSessionEnded ); // Menghapus event listener saat sesi berakhir
            currentSession = null; // Mengatur sesi saat ini menjadi null
            
            if (self.chair !== null){
                self.scene.remove( self.chair ); // Menghapus chair dari scene
                self.chair = null; // Mengatur chair menjadi null
            }
            
            self.renderer.setAnimationLoop( null ); // Menghentikan animasi loop pada renderer
        }

        if ( currentSession === null ) {
            // Meminta sesi AR jika belum ada sesi yang berjalan
            navigator.xr.requestSession( 'immersive-ar', sessionInit ).then( onSessionStarted );
        } else {
            // Mengakhiri sesi AR saat ini jika ada
            currentSession.end();
        }
    }
    
    requestHitTestSource(){
        const self = this;
        
        const session = this.renderer.xr.getSession(); // Mendapatkan sesi XR dari renderer

        session.requestReferenceSpace( 'viewer' ).then( function ( referenceSpace ) {
            session.requestHitTestSource( { space: referenceSpace } ).then( function ( source ) {
                self.hitTestSource = source; // Menyimpan hit test source
            } );
        } );

        session.addEventListener( 'end', function () {
            self.hitTestSourceRequested = false; // Mengatur flag hit test source menjadi false
            self.hitTestSource = null; // Mengatur hit test source menjadi null
            self.referenceSpace = null; // Mengatur ruang referensi menjadi null
        } );

        this.hitTestSourceRequested = true; // Mengatur flag hit test source menjadi true
    }
    
    getHitTestResults( frame ){
        const hitTestResults = frame.getHitTestResults( this.hitTestSource ); // Mendapatkan hasil hit test dari frame

        if ( hitTestResults.length ) {
            const referenceSpace = this.renderer.xr.getReferenceSpace(); // Mendapatkan ruang referensi XR
            const hit = hitTestResults[ 0 ]; // Mendapatkan hasil hit test pertama
            const pose = hit.getPose( referenceSpace ); // Mendapatkan pose dari hit test

            this.reticle.visible = true; // Menampilkan reticle
            this.reticle.matrix.fromArray( pose.transform.matrix ); // Mengatur matriks reticle dari pose transform
        } else {
            this.reticle.visible = false; // Menyembunyikan reticle jika tidak ada hasil hit test
        }
    }
    
	render( timestamp, frame ) {
        if ( frame ) {
            if ( this.hitTestSourceRequested === false ) this.requestHitTestSource( ); // Meminta hit test source jika belum diminta
            if ( this.hitTestSource ) this.getHitTestResults( frame ); // Mendapatkan hasil hit test dari frame jika hit test source tersedia
        }

        this.renderer.render( this.scene, this.camera ); // Merender scene dengan kamera
    }
}

export { App }; // Mengekspor kelas App
