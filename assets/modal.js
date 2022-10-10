
let modal = document.getElementById('myModal');


let span = document.getElementsByClassName("close")[0];
    
// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}
    
// Get all images and insert the clicked image inside the modal
// Get the content of the image description and insert it inside the modal image caption
let images = document.getElementsByTagName('img');
let modalImg = document.getElementById("imgModal");
let captionText = document.getElementById("caption");
let i;
for (i = 0; i < images.length; i++) {
    images[i].onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        modalImg.alt = this.alt;
        captionText.innerHTML = this.nextElementSibling.innerHTML;
    }
}