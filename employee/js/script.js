
const preview_image = () => {
    let selectedImage = document.getElementById("p_image")
    let imageViewer = document.getElementById("image_viewer")

    // Triger the file input 
    selectedImage.click()

    selectedImage.addEventListener("change", (event) => {
        let inputImage = URL.createObjectURL(event.target.files[0])
        imageViewer.src = inputImage
    })
}
