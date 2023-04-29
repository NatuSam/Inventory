function hide(x){ 
    var C = 'none';
    var A = 'none';
    var Anum = 'none';
    var T = 'none';
    var S = 'none';
    var Ra = 'none';
    var Rt = 'none';
    var Tr = 'none';
    var E = 'none';
switch(x){                
    case 1:              
        C = 'block';
        break;
    case 2: 
        A ='block';
        break;
    case 3:
        Anum='block';
        break;
    case 4:
        T='block';
        break;
    case 5:
        S='block';
        break;
    case 6:
        Ra='block';
        break;
    case 7:
        Rt='block';
        break;
    case 8:
        Tr='block';
        break;
    case 9:
        E='block';
        break;
    default:
        break;
    }
    document.getElementById('Check').style.display=C;
    document.getElementById('Add').style.display=A;
    document.getElementById('Addnum').style.display=Anum;
    document.getElementById('Take').style.display=T; 
    document.getElementById('Store').style.display=S;
    document.getElementById('ResultA').style.display=Ra; 
    document.getElementById('ResultT').style.display=Rt; 
    document.getElementById('Tr').style.display=Tr;
    document.getElementById('newEmp').style.display=E; 

    if(document.getElementById('Result')!=undefined){
    document.getElementById('Result').style.display='none';}
    if(document.getElementById('storeResult')!=undefined){
    document.getElementById('storeResult').style.display='none';}  
    if(document.getElementById('Tresult')!=undefined){ 
    document.getElementById('Tresult').style.display='none';   }
      
}
//box
let timer;

document.addEventListener('input', e => {
  const el = e.target;
  
  if( el.matches('[data-color]') ) {
    clearTimeout(timer);
    timer = setTimeout(() => {
      document.documentElement.style.setProperty(`--color-${el.dataset.color}`, el.value);
    }, 100)
  }
})

