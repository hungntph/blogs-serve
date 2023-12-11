let loadFile = function(event) {
  let showImage = document.getElementById('showImage');
  showImage.src = URL.createObjectURL(event.target.files[0]);
  showImage.onload = function() {
    URL.revokeObjectURL(showImage.src);
  };
};
