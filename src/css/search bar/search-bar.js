let suggestions= [
    "JavaScript is a popular programming language for web development.",
    "Arrays are a fundamental data structure in JavaScript programming.", 
    "Functions are reusable blocks of code in JavaScript programming.", 
    "Objects are a key feature of JavaScript programming language.",
    "Loops are used to iterate over arrays and objects.", 
    "Conditional statements are used to execute code based on conditions.", 
    "Variables are used to store data in JavaScript programming.", 
    "Strings are a data type used to represent text in JavaScript.", 
    "Numbers are a data type used to represent numeric values.", 
    "Booleans are a data type used to represent true/false values.",
    "Regular expressions are used to match patterns in strings.", 
    "JSON is a popular data format used in web development.", 
    "Node.js is a popular JavaScript runtime environment.", 
    "React is a popular JavaScript library for building user interfaces."
]

const searchwrapper = document.querySelector(".suggestion-input-container");
const inputBox = document.querySelector(".search-bar-input");
const suggBox = document.querySelector(".suggestion-box");

inputBox.addEventListener('keypress' , function(e){
    // console.log(e.target.value);
    let userdata = e.target.value;
    let emptyArray = [];
    if(userdata){
        emptyArray = suggestions.filter((data)=>{
            return data.toLocaleLowerCase().startsWith(userdata.toLocaleLowerCase());
        });
        // console.log(emptyArray)
        
        emptyArray = emptyArray.map((data)=>{
            return data = '<li>' + data + '</li>'
        }); 
        console.log(emptyArray)
        searchwrapper.classList.add('active');
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for(let i = 0; i < allList.length; i++){
            allList[i].setAttribute("onclick", "select(this) ")
        }
    }else{
        searchwrapper.classList.remove('active');
    }

})

function select(element){
    let selectUserData = element.textContent;
    // console.log(selectUserData)
    inputBox.value = selectUserData;
    searchwrapper.classList.remove('active');
}

function showSuggestions(list){
    let listData;
    if(!list.length){
        userValue = inputBox.value
        listData = '<li>' + userValue + '</li>'
    }else{
        listData = list.join('')
    }
    suggBox.innerHTML = listData
}