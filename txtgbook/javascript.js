// JavaScript Document
var aperto = "no";

function apri_box() {
if (aperto == "no") {
document.getElementById('div').style.display = 'inline';
aperto = "si";
} else {
document.getElementById('div').style.display = 'none';
aperto = "no";
}
}

function elimina(num) {
if(confirm("Elimini il messaggio # "+num+" ?")) {
location.href="elabora.php?azione=elimina&num="+num;
}
}

function smiley(code) {
 var testo = document.form.mess.value; 
 this.code = code;
 document.form.mess.value = testo + code;
}

function bbcode(tag) {
 var testo = document.form.mess.value; 
 this.tag = tag;
 document.form.mess.value = testo + '['+tag+'][/'+tag+']';
}

function conta(val) { 
  if (val.mess.value.length > max) {
    val.mess.value = val.mess.value.substring(0,max);
    rest = 0;
  } else {
    rest = max - val.mess.value.length;
  }
  val.num.value = rest;
}

function checkskin() {
         var selIdx = document.getElementById('skin').selectedIndex;
         var newSel = document.getElementById('skin').options[selIdx].value;
         location.href='configura.php?skin='+ newSel +'';
}