let ActionBtnCount=document.querySelectorAll(".dialog .action-btn .action").length;
for(let i=0;i<ActionBtnCount;i++){
    document.querySelectorAll(".dialog .action-btn .action")[i].addEventListener("click",function(){
        addList(this);
    });
}
// function addList(child,index){
//     const element = document.querySelectorAll(".dialog .action-btn .action")[index].parentNode.parentNode.querySelector(".list-item .items");
//     const newItem =document.createElement("li");
//     const node =document.createTextNode("<ul class=\"items\">    <li class=\"in-item\">       <div class=\"ico\">A</div>       <input type=\"text\" name=\"\" class=\"item-text\" placeholder=\"List item\">        <span class=\"num-checkbox\">        <span>100 +</span> <input class =\"chkbox \" type=\"checkbox\" name=\"#\" />        </span>    </li>    <br></ul>");
//     newItem.appendChild(node);
//     element.appendChild(newItem);
// }
function addList(child){
    const element = child.parentNode.parentNode.querySelector(".list-item .items");
    const newItem = document.createElement("li");
    newItem.innerHTML = '<li class="in-item"><div class="ico">A</div><input type="text" name="" class="item-text" placeholder="List item"><span class="num-checkbox"><span>100 +</span> <input class="chkbox" type="checkbox" name="#"></span></li> <br>';
    element.appendChild(newItem);
}
