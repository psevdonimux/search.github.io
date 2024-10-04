<html id="hm">
<title>Поисковая система</title>
<script src="Design.js"></script>
<link rel="stylesheet" href="Index.css">
<link rel="icon" href="image/icon.webp">
<form onsubmit="search(event, this.searching.value);">
 <input name="searching" id="searching">
</form>
<button id="one" onclick="clickOn()">ТЫК</button>
<button id="settings">Настройки</button>
<div id="modal">
<div id="content">
<h1 id="title">Настройки</h1>
<input type="range" id="transparent" min="0" max="10" /> 
<p id="msg">Прозрачность кнопок<p>
<p id="msg2">Тема<p>
<button id="mode" onclick="modeUpdate()"></button> 
<p id="msg3">Поисковик<p>
<select id="optionsMenu">
 <option value="https://yandex.eu/search/touch/?text=">Yandex</option>
 <option value="https://www.google.com/search?q=">Google</option>
 <option value="https://www.bing.com/search?q=">Bing</option>
</select>
<p id="msg4">ChatGPT<p>
<button id="chatgpt"></button> 
</div>
</div>
<img id="imgc">
<script>
var design = new Design();
design.createModal('modal', 'content', 'settings');
function search(event, value){
 event.preventDefault();
 location.replace((localStorage.getItem('search') ?? 'https://yandex.eu/search/touch/?text=') + value);
}
function mode(){
 design.cssMode(['hm', 'searching', 'settings', 'mode', 'content', 'title', 'optionsMenu', 'chatgpt']); 
 document.getElementById('mode').innerHTML = design.isDarkMode() ? 'Тёмная' : 'Светлая';
 design.cssMode(['searching'], design.isDarkMode() ? '#FFFFFF' : '#000000', 'transparent');
 design.cssBorder(['searching']);
 design.imageMode(['imgc'], ['chatgpt.webp']);
}
function modeUpdate(){
 design.updateMode();
 mode();
}
if(localStorage.getItem('info') == null){
 localStorage.setItem('info', JSON.stringify({}));
}
function imageLoad(){
var imageSrc = localStorage.getItem('image');
var image = document.getElementById('hm').style;
 if(imageSrc != ''){
 image.backgroundImage = 'url(' + imageSrc + ')';
 image.backgroundSize = `${window.innerWidth}px ${window.innerHeight}px`;
}
}
imageLoad();
var transparent = document.getElementById('transparent');
var optionsMenu = document.getElementById('optionsMenu');
var content = document.getElementById('content').style;
var chatgpt = document.getElementById('chatgpt');
var imgc = document.getElementById('imgc');
var close = document.getElementById('close');
chatgpt.innerHTML = localStorage.getItem('chatgpt') == 'true' ? 'Включён' : 'Отключён';
chatgpt.onclick = function(){
 localStorage.setItem('chatgpt', localStorage.getItem('chatgpt') == 'true' ? 'false' : 'true');
 chatgpt.innerHTML = localStorage.getItem('chatgpt') == 'true' ? 'Включён' : 'Отключён';
 imgc.style.width = localStorage.getItem('chatgpt') == 'true' ? '20%' : '0%';
 imgc.style.height = localStorage.getItem('chatgpt') == 'true' ? '40%' : '0%';
}; 
transparent.value = localStorage.getItem('transparent') * 10 ?? 0;
document.getElementById('settings').style.opacity = localStorage.getItem('transparent') ?? 0;
document.getElementById('imgc').style.opacity = localStorage.getItem('transparent') ?? 0;
transparent.onchange = function(event){
 localStorage.setItem('transparent', event.target.value / 10);
 document.getElementById('settings').style.opacity = localStorage.getItem('transparent');
 document.getElementById('imgc').style.opacity = localStorage.getItem('transparent');
};
optionsMenu.onchange = function(event){
 localStorage.setItem('search', event.target.value);
};
if(localStorage.getItem('chatgpt') == 'true'){
 imgc.style.width = window.innerWidth < window.innerHeight ? '32%' : '20%';
 imgc.style.height = window.innerWidth < window.innerHeight ? '15%' : '42%';
}
else{
 imgc.style.width = '0%';
 imgc.style.height = '0%';
}
imgc.onclick = function(){
 location.replace('https://dev.yqcloud.top/');
};
function activate(){
 content.marginTop = window.innerWidth < window.innerHeight ? '80%' : '10%';
 content.width = window.innerWidth < window.innerHeight ? '60%' : '25%';
 content.height = window.innerWidth < window.innerHeight ? '23%' : '50%';
 close.style.fontSize = window.innerWidth < window.innerHeight ? '400%' : '200%';
}
window.onresize = function(){
 imageLoad();
 if(localStorage.getItem('chatgpt') == 'true'){
  imgc.style.width = window.innerWidth < window.innerHeight ? '32%' : '20%';
  imgc.style.height = window.innerWidth < window.innerHeight ? '15%' : '42%';
 }
  activate();
}; 
optionsMenu.value = localStorage.getItem('search') ?? 'https://yandex.eu/search/touch/?text=';
activate();
mode();
function clickOn(){
var split = prompt().split(' ');
var info = JSON.parse(localStorage.getItem('info'));
var ls = info[split[0]];
if(split[0] == "image" && split[1] != null){
 localStorage.setItem(split[0], split[1]);
 imageLoad();
}
else if(split[0] == "list"){
var arr = [];
var i = 0;
for(let key in info){
 arr[i] = key + ' - ' + info[key];
 i++;
}
 alert(arr.join('\n'));
}
else if(split[0] == 'delete' && split[1] != null && info[split[1]] != null){
 delete info[split[1]];
 localStorage.setItem('info', JSON.stringify(info));
}
else if(split[0] == 'clearAll'){
 localStorage.removeItem('info');
}
else if(split.length == 2){
 info[split[0]] = split[1];
 localStorage.setItem('info', JSON.stringify(info));
}
else if(ls != null){
 location.replace(ls);
}
}
</script>
</html>
