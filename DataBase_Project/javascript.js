const loginPopUp = document.querySelector("#container");

window.addEventListener("load", function(){
    showPopUp();
})

function showPopUp(){
    const timerlimit = 1
    let i = 0;
    const timer = setInterval(function(){
        i++;
        if(i == timerlimit){
            clearInterval(timer);
            loginPopUp.classList.add("show");
        }
        console.log(i)
    },1000);

}