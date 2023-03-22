const imageInputFile = document.getElementById("image");
const imageView      = document.getElementById("image-view");

imageInputFile.addEventListener("change", (e) => {
    const file = e.target.files[0];

    imageView.src = URL.createObjectURL(file);
});
