const terms=document.getElementById("terms");

const button=document.getElementById("connectBtn");

terms.addEventListener("change",()=>{

    button.disabled=!terms.checked;

});
