var wrapper = document.getElementById("guarantor_1_signature_pad");
//var wrapper_second = document.getElementById("guarantor_2_signature_pad");

//var clearButton = wrapper.querySelector("[data-action=clear]");
//var savePNGButton = wrapper.querySelector("[data-action=save-png]");
//var saveSVGButton = wrapper.querySelector("[data-action=save-svg]");

var submitLoanAppBtn = document.getElementById("loan_application_form_submit");

var canvas = wrapper.querySelector("canvas");
//var canvas_second = wrapper_second.querySelector("canvas");

var signaturePad = new SignaturePad(canvas);
//var signaturePad2 = new SignaturePad(canvas2);

alert("test");

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
    // When zoomed out to less than 100%, for some very strange reason,
    // some browsers report devicePixelRatio as less than 1
    // and only part of the canvas is cleared then.
    var ratio =  Math.max(window.devicePixelRatio || 1, 1);

    // This part causes the canvas to be cleared
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
    
    //canvas2.width = canvas2.offsetWidth * ratio;
    //canvas2.height = canvas2.offsetHeight * ratio;
    //canvas2.getContext("2d").scale(ratio, ratio);

    // This library does not listen for canvas changes, so after the canvas is automatically
    // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
    // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
    // that the state of this library is consistent with visual state of the canvas, you
    // have to clear it manually.
    signaturePad.clear();
    //signaturePad2.clear();
}

window.onresize = resizeCanvas;
resizeCanvas();

/*clearButton.addEventListener("click", function (event) {
    signaturePad.clear();
});*/

/*savePNGButton.addEventListener("click", function (event) {
    if (signaturePad.isEmpty()) {
        alert("Please provide signature first.");
    } else {
        window.open(signaturePad.toDataURL());
    }
});

saveSVGButton.addEventListener("click", function (event) {
    if (signaturePad.isEmpty()) {
        alert("Please provide signature first.");
    } else {
        window.open(signaturePad.toDataURL('image/svg+xml'));
    }
});*/

submitLoanAppBtn.addEventListener("click", function (event) {
	if (signaturePad1.isEmpty()) {
        alert("Please provide signature first.");
    } else {
        window.open(signaturePad1.toDataURL('image/svg+xml'));
    }
    
    if (signaturePad2.isEmpty()) {
	    alert("Please provide signature first.");
    } else {
        window.open(signaturePad2.toDataURL('image/svg+xml'));
    }
});