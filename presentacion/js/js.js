
let links = document.querySelectorAll("header a");
let main = document.querySelector("main");
links.forEach((link)=>{
    link.addEventListener("click",(e)=>{
        e.preventDefault() 
        let id = link.id
        let archivo = id + ".php"
        location.hash = link.id

       // let selector = document.querySelector(links);
      //  selector.style.color = "red";
  
    })
})



let pagina_inicial = ajax("Bienvenida.php");
pagina_inicial.addEventListener("load", ()=>{
    location.hash = "Bienvenida"
    if(pagina_inicial.status == 200){
        main.innerHTML = pagina_inicial.response
    }
})



function ajax(url,metodo){
    let http_metodo = metodo || "GET"
    let xhr = new XMLHttpRequest;
    xhr.open(http_metodo,url)
    xhr.send()
    return xhr
}



window.addEventListener("hashchange",()=>{

    links.forEach((linkb)=>{
        let comp = linkb.id
        let hasy = location.hash.split("#")[1]
        if(comp == hasy){
            linkb.className += "activo";
            console.log(linkb)
        }else{
            linkb.className = "";
        }
    })

    let archivo = location.hash.split("#")[1] + ".php"
    let xhr = ajax(archivo)
    xhr.addEventListener("load",()=>{
        if(xhr.status == 200){
            main.innerHTML = xhr.response
        }
    })
})