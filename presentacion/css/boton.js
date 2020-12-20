function c1v1(){
    var mostrar = document.querySelector('.popup');
    
        if(mostrar.style.display === 'block'){
            mostrar.style.display = 'none';
            document.querySelector('.c1').style.paddingBottom ='0.8rem';
        }else{
            mostrar.style.display = 'block';
            document.querySelector('.c1').style.paddingBottom ='0%';
        }
    }