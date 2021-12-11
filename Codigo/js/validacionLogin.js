//Validacion del usuario del login
let usu=document.getElementById('usuario');
let avisoUsu=document.getElementById('avisoUsuario');
const inputValidado={Usuario:false, Pass:false}
function validarUsuario(){
    if(usu.value!="" && usu.value!=undefined){
        //Comprobamos que sigue la expresion regular
        if(/[a-zA-ZáéíóúÁÉÍÓÚ]{6,45}/.test(usu.value)){
            //cambiamos el color del borde
            usu.classList.remove('is-invalid');
            usu.classList.add('is-valid');
            //ponemos si se cumple que se ha validado
            inputValidado.Usuario=true;
            inputValidadoIng[0]=true;
            //vaciamos el aviso 
            avisoUsu.innerHTML=" ";
        }else{
            usu.classList.remove('is-valid');
            usu.classList.add('is-invalid');
            avisoUsu.innerHTML=" ";
            //no sigue la expresion borde rojo, metemos el mensaje
            
            inputValidado.Usuario=false;
            inputValidadoIng[0]=false;
            avisoUsu.innerHTML="El usuario de contener al menos 6 carecteres";
        }            
    }else{
        avisoUsu.innerHTML="Debe rellenar el campo usuario";
        usu.classList.remove('is-valid');
        usu.classList.add('is-invalid');
        inputValidado.Usuario=false;
        inputValidadoIng[0]=false;
        
    }
}
usu.addEventListener('keyup',validarUsuario);
//Validacion contraseña login
let pass=document.getElementById('pass');
let avisoPass=document.getElementById('avisoPass');
function validarPass(){
    //Aseguramos que no esta vacio o no definido
    if(pass.value!="" && pass.value!=undefined){
        //aseguramos que sige la expresion
        if(/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,40}/.test(pass.value)){
            pass.classList.remove('is-invalid');
            pass.classList.add('is-valid');
            //variable de control a true, color del bode rojo y vaciamos el aviso
            inputValidadoIng[1]=true;
            inputValidado.Pass=true;
            avisoPass.innerHTML=" ";
        }else{
            pass.classList.remove('is-valid');
            pass.classList.add('is-invalid');
            inputValidado.Pass=false;
            inputValidadoIng[1]=false;
            avisoPass.innerHTML="No es suficientemente segura";
        }        
    }else{
        pass.classList.remove('is-valid');
            pass.classList.add('is-invalid');
            avisoPass.innerHTML="Debe rellenar el campo contraseña";
        inputValidado.Pass=false;
        inputValidadoIng[1]=false;
    }
}
pass.addEventListener('keyup',validarPass);



//Ingreso
const expr={telefono:/[0-9]{9}/, usuario:/[a-zA-ZáéíóúÁÉÍÓÚ]{6,45}/, dni:/^[0-9]{8}[a-zA-Z]$/, email:/^[A-Za-z]{1,15}[@]{1}[A-Za-z]{1,15}[.]{1}[A-Za-z]{1,5}$/, pass:/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,40}/, nombre:/^[A-Za-záéíóúÁÉÍÓÚ]+[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ]+[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ]{2,}?$/, direccion:/^([A-Za-záéíóúÁÉÍÓÚ/,0-9]{1,}[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ/,0-9]*[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ/,0-9]*[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ/,0-9]*[ ]{0,1}){0,50}?$/}
//el array input validado, es para controlar si ha sido validado todos los campos antes de enviarlo
let inputValidadoIng=[false, false, false, false, false,false,false,false,false,false];


let DNI=document.getElementById('dni');
let avisoDni=document.getElementById('avisoDNI');
function validarDNI(){
    if(DNI.value!="" && DNI.value!=undefined){
        if(expr.dni.test(DNI.value)){

            let numero = parseInt(DNI.value.substr(0, 8));
            let letraDNI = DNI.value.substr(8, 9);
            letraDNI=letraDNI.toUpperCase();
            console.log(numero);
            numero = numero%23;
            console.log(letraDNI);
            console.log(numero);
            letra=['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
            if (letra[numero]!=letraDNI){
                DNI.classList.remove('is-valid');
                DNI.classList.add('is-invalid');
                avisoDni.innerHTML="";
                avisoDni.innerHTML="La letra del DNI es incorrecta";
                inputValidadoIng[2]=false;
            }else{
                DNI.classList.remove('is-invalid');
                DNI.classList.add('is-valid');
                inputValidadoIng[2]=true;
                avisoDni.innerHTML="";
            }
        }else{
            DNI.classList.remove('is-valid');
                DNI.classList.add('is-invalid');
            avisoDni.innerHTML="00000000x";
            inputValidadoIng[2]=false;
        }
    }else{
        DNI.classList.remove('is-valid');
                DNI.classList.add('is-invalid');
                avisoDni.innerHTML="Debe rellenar todos los campos";
                inputValidadoIng[2]=false;
        
    }   
}
DNI.addEventListener('keyup',validarDNI);

let apellido1=document.getElementById('apellidos');
let avisoapellido=document.getElementById('avisoApellidos');
//Fase123@as
function validarApellido1(){
    if(apellido1.value!="" && apellido1.value!=undefined){
        if(expr.nombre.test(apellido1.value)){
            apellido1.classList.remove('is-invalid');
            apellido1.classList.add('is-valid');
            avisoapellido.innerHTML=" ";
            inputValidadoIng[3]=true;
        }else{
            apellido1.classList.remove('is-valid');
            apellido1.classList.add('is-invalid');
            avisoapellido.innerHTML="Formato de apellidos no valido";
            inputValidadoIng[3]=false;
        } 
    }else{
        apellido1.classList.remove('is-valid');
        apellido1.classList.add('is-invalid');
        avisoapellido.innerHTML="Debe rellenar todos los campos";
        inputValidadoIng[3]=false;
    }
           
}

apellido1.addEventListener('keyup',validarApellido1);

//Telefono
let telefono=document.getElementById('telefono');
let avisoTelefono=document.getElementById('avisoTel');
//Fase123@as
function validarTelefono(){
    if(telefono.value!="" && telefono.value!=undefined){
        if(expr.telefono.test(telefono.value)){
            telefono.classList.remove('is-invalid');
            telefono.classList.add('is-valid');
            avisoTelefono.innerHTML=" ";
            inputValidadoIng[4]=true;
        }else{
            telefono.classList.remove('is-valid');
            telefono.classList.add('is-invalid');
            avisoTelefono.innerHTML="Telefono no valido";
            inputValidadoIng[4]=false;
        } 
    }else{
        telefono.classList.remove('is-valid');
        telefono.classList.add('is-invalid');
        avisoTelefono.innerHTML="Debe rellenar todos los campos";
        inputValidadoIng[4]=false;
      
    }
           
}

telefono.addEventListener('keyup',validarTelefono);
//Email
let email=document.getElementById('email');
let avisoEmail=document.getElementById('avisoEmail');
function validarEmail(){
    if(email.value!="" && email.value!=undefined){
        if(expr.email.test(email.value)){
            email.classList.remove('is-invalid');
            email.classList.add('is-valid');
            avisoEmail.innerHTML=" ";
            inputValidadoIng[5]=true;
        }else{
            email.classList.remove('is-valid');
            email.classList.add('is-invalid');
            avisoEmail.innerHTML="Email no valido";
            inputValidadoIng[5]=false;
        } 
    }else{
        email.classList.remove('is-valid');
        email.classList.add('is-invalid');
        avisoEmail.innerHTML="Debe rellenar todos los campos";
        inputValidadoIng[5]=false;
    }
           
}

email.addEventListener('keyup',validarEmail);
//provicia comunidad


let pass2=document.getElementById('pass1');
let avisoPass2=document.getElementById('avisoPass1');
function validarPass2(){
    if(pass2.value!="" && pass2.value!=undefined){
        if(inputValidadoIng[1]){
            let contra1=pass.value;
            let contra2=pass2.value;
            if(contra1==contra2){
                pass2.classList.remove('is-invalid');
                pass2.classList.add('is-valid');
                avisoPass2.innerHTML=" ";
                inputValidadoIng[6]=true;
            }else{
                avisoPass2.innerHTML="Las contraseña no coinciden";
                pass2.classList.remove('is-valid');
            pass2.classList.add('is-invalid');
            inputValidadoIng[6]=false;
           
            }
        }else{
            avisoPass2.innerHTML="Debe de ser valida la primera contraseña";
            pass2.classList.remove('is-valid');
            pass2.classList.add('is-invalid');
            inputValidadoIng[6]=false;
        }            
    }else{
        avisoPass2.innerHTML="Debe rellenar todos los campos";
        pass2.classList.remove('is-valid');
        pass2.classList.add('is-invalid');
        inputValidadoIng[6]=false;
    }
}
pass2.addEventListener('keyup',validarPass2);
//Direccion
let direccion=document.getElementById('direccion');
let avisoDireccion=document.getElementById('avisoDirec');
function validarDireccion(){
    if(direccion.value!="" && direccion.value!=undefined){
        if(expr.nombre.test(direccion.value)){
            direccion.classList.remove('is-invalid');
            direccion.classList.add('is-valid');
            avisoDireccion.innerHTML=" ";
            inputValidadoIng[7]=true;
        }else{
            direccion.classList.remove('is-valid');
            direccion.classList.add('is-invalid');
            avisoDireccion.innerHTML="direccion no valida";
            inputValidadoIng[7]=false;
        } 
    }else{
        direccion.classList.remove('is-valid');
        direccion.classList.add('is-invalid');
        avisoDireccion.innerHTML="Debe rellenar todos los campos";
        inputValidadoIng[7]=false;
    }
           
}

direccion.addEventListener('keyup',validarDireccion);

//comunidad
let comunidad=document.getElementById('comunidad');
let avisoComunidad=document.getElementById('avisoComunidad');
function validarDireccion(){
    if(comunidad.value!="0" && comunidad.value!=undefined){
            comunidad.classList.remove('is-invalid');
            comunidad.classList.add('is-valid');
            avisoComunidad.innerHTML=" ";
            inputValidadoIng[8]=true;
    }else{
        comunidad.classList.remove('is-valid');
        comunidad.classList.add('is-invalid');
        avisoComunidad.innerHTML="Debe seleccionar comunidad,provincia y cp";
        inputValidadoIng[8]=false;
      
    }
           
}

comunidad.addEventListener('change',validarDireccion);
//nombre

let nombre=document.getElementById('nombre');
let avisoNombre=document.getElementById('avisoNombre');
//Fase123@as
function validarNombre(){
    if(nombre.value!="" && nombre.value!=undefined){
        if(expr.nombre.test(nombre.value)){
            nombre.classList.remove('is-invalid');
            nombre.classList.add('is-valid');
            avisoNombre.innerHTML=" ";
            inputValidadoIng[9]=true;
        }else{
            nombre.classList.remove('is-valid');
            nombre.classList.add('is-invalid');
            avisoNombre.innerHTML="Formato de nombre no valido";
            inputValidadoIng[9]=false;
        } 
    }else{
        nombre.classList.remove('is-valid');
        nombre.classList.add('is-invalid');
        avisoNombre.innerHTML="Debe rellenar todos los campos";
        inputValidadoIng[9]=false;
    }
           
}

nombre.addEventListener('keyup',validarNombre);

//control del envio del formulario alta
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("alta").addEventListener('submit', validarFormulario, false); 
  });
  function validarFormulario(evento) {
   
    let contador=0;
    for(let i=0;i<inputValidadoIng.length;i++){
        if(inputValidadoIng[i]){
            contador++;
            console.log(contador);
        }
    }
    if(contador>6){
        document.getElementById("avisoForm").innerHTML="";
    }else{
        document.getElementById("avisoForm").innerHTML="El formulario debe ser completamente valido para enviarlo";
        evento.preventDefault();
    }
   
    
}

//control del envio del formulario Login
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("login").addEventListener('submit', validarFormularioLog, false); 
  });
  function validarFormularioLog(evento) {
    
    //Que al pulsar no se envie sino que primero cumpla la condicion validado true todos los campos
	e.preventDefault();
    if(inputValidado.usuario==true && inputValidado.Pass==true){
        document.getElementById('formulario').submit();
        document.getElementById('avisoFormulario').innerHTML="";
    }else{
        document.getElementById('avisoFormulario').innerHTML="El formulario debe ser completamente valido para enviarlo";
    }
	
}
