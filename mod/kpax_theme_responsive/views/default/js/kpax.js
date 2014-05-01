;(function(win, doc, $) {
	var oForm = doc.querySelector?doc.querySelector("form.elgg-form-avatar-upload"):
		$("form.elgg-form-avatar-upload")[0],
		oDiv, fpDragEnter, fpDragLeave, fpCancel, fpDrop;
 
	if(oForm && typeof win.FileReader !== 'undefined' && typeof FormData === "function") {
		/** Define Drag&Drop Functionallity at init time **/
	
		/**
		 * Avoid natural behavior of the browser (replace the whole page with the image)
		 */
		fpCancel = function(e) {
			if(e.preventDefault) {
				e.preventDefault();
			}
			return false;
		}
		fpDragEnter = function(e) {
			this.className += " dropfile-dragover";
			return fpCancel(e);
		 }
		fpDragLeave = function(e) {
			this.className="dropfile-inactive dropfile-init";
			return fpCancel(e);
		}
		fpDrop = function(e) {
			var file, reader, that = this;
			if(e.stopPropagation) {
				e.stopPropagation();
				e.preventDefault();
			}
			file = e.dataTransfer.files[0];

      		if(file && file.type.indexOf("image") !== -1) {
      			this.innerHTML = "<img src='/elgg/mod/theme_kPAX/graphics/ajax-loader.gif' alt=''>";
	      		reader = new FileReader();

	      		// Once the image is loaded set it as the background and SEND it via AJAX POST
	  			reader.onload = function (event) {
	  				var oForm = doc.querySelector?doc.querySelector("form.elgg-form-avatar-upload"):
							$("form.elgg-form-avatar-upload")[0];
	  					formdata = new FormData(oForm),
	  					xhr = new XMLHttpRequest(),
	  					url = win.location.href;

				  	that.style.background = 'url(' + event.target.result + ') no-repeat center';
	  				that.className ="dropfile-inactive";

					formdata.append("avatar", file);
					xhr.onreadystatechange = function() {
						if(this.readyState === 4 && this.status === 200) {
							win.location.href = url;
						}
					}
					xhr.open("POST", url.slice(0, url.indexOf("/avatar")) +"/action/avatar/upload");  
					xhr.send(formdata);
					oForm = formdata = xhr = null;
	  			};
	  			reader.readAsDataURL(file);
  			}
			return fpDragLeave.call(this, e);

		}
		oDiv = document.createElement("div");
		oDiv.className = "dropfile-inactive dropfile-init";
		oDiv.ondragenter = fpDragEnter;
		oDiv.ondragleave = fpDragLeave;
		oDiv.ondrop = fpDrop;
		oDiv.ondragover = fpCancel;
		oDiv.ondragend = fpCancel;
		oForm.appendChild(oDiv);

	// Avoid memory leaks
	oForm = oDiv = null;
	}
}(window, document, jQuery))