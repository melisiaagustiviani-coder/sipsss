let warga = JSON.parse(localStorage.getItem("warga")) || [];

function login(){

let username =
document.getElementById("username").value;

let password =
document.getElementById("password").value;

if(username === "admin" &&
password === "admin123"){

document.getElementById("loginPage")
.style.display = "none";

document.getElementById("dashboardPage")
.style.display = "block";

loadWarga();

}else{

alert("Login gagal");

}

}

function logout(){

location.reload();

}

function tambahWarga(){

let nama =
document.getElementById("namaWarga").value;

if(nama === ""){
alert("Nama kosong");
return;
}

warga.push(nama);

localStorage.setItem("warga",
JSON.stringify(warga));

document.getElementById("namaWarga").value="";

loadWarga();

}

function loadWarga(){

let table =
document.getElementById("tableWarga");

table.innerHTML="";

warga.forEach((item,index)=>{

table.innerHTML += `

<tr>

<td>${index+1}</td>

<td>${item}</td>

<td>

<button class="btn btn-danger btn-sm"
onclick="hapusWarga(${index})">

Hapus

</button>

</td>

</tr>

`;

});

document.getElementById("jumlahWarga")
.innerText = warga.length;

document.getElementById("jumlahBayar")
.innerText = warga.length;

}

function hapusWarga(index){

warga.splice(index,1);

localStorage.setItem("warga",
JSON.stringify(warga));

loadWarga();

}

function uploadBukti(){

let file =
document.getElementById("buktiBayar")
.files[0];

if(!file){
alert("Pilih gambar");
return;
}

let reader = new FileReader();

reader.onload = function(e){

document.getElementById("preview")
.innerHTML = `

<h5>Bukti Pembayaran</h5>

<img src="${e.target.result}">

`;

}

reader.readAsDataURL(file);

}
