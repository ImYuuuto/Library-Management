const form = document.getElementById("bookForm");

const dropZone = document.getElementById("dropZone");
const fileInput = document.getElementById("bookImg");

const pdfZone = document.getElementById("pdfZone");
const pdfInput = document.getElementById("bookPdf");

const previewContainer = document.getElementById("previewContainer");

let selectedImage = null;
let selectedPdf = null;

/* =========================
   IMAGE
========================= */

dropZone.addEventListener("click", () => fileInput.click());

fileInput.addEventListener("change", (e) => {
    selectedImage = e.target.files[0];
});

dropZone.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZone.classList.add("dragover");
});

dropZone.addEventListener("dragleave", () => {
    dropZone.classList.remove("dragover");
});

dropZone.addEventListener("drop", (e) => {
    e.preventDefault();
    dropZone.classList.remove("dragover");

    selectedImage = e.dataTransfer.files[0];

    // safer way
    fileInput.files = e.dataTransfer.files;
});

/* =========================
   PDF (FIXED)
========================= */

pdfZone.addEventListener("click", () => pdfInput.click());

pdfInput.addEventListener("change", (e) => {
    selectedPdf = e.target.files[0];
});

pdfZone.addEventListener("dragover", (e) => {
    e.preventDefault();
    pdfZone.classList.add("dragover");
});

pdfZone.addEventListener("dragleave", () => {
    pdfZone.classList.remove("dragover");
});

pdfZone.addEventListener("drop", (e) => {
    e.preventDefault();
    pdfZone.classList.remove("dragover");

    const file = e.dataTransfer.files[0];

    if (file.type !== "application/pdf") {
        alert("Only PDF files allowed!");
        return;
    }

    selectedPdf = file;
});

/* =========================
   FORM SUBMIT (ONE CARD ONLY)
========================= */

form.addEventListener("submit", () => {

    const name = document.getElementById("bookName").value.trim();
    const desc = document.getElementById("bookDescription").value.trim();

    if (!name || !desc) {
        alert("Please fill all fields!");
        return;
    }

    if (!selectedImage) {
        alert("Please upload a book image!");
        return;
    }

    if (!selectedPdf) {
        alert("Please upload a PDF!");
        return;
    }

    const reader = new FileReader();

    reader.onload = function (e) {

        // ❗ REMOVE OLD CARD (ONLY ONE AT A TIME)
        previewContainer.innerHTML = "";

        const card = document.createElement("div");
        card.classList.add("book-card");

        card.innerHTML = `
            <img src="${e.target.result}">
            <div class="content">
                <h3>${name}</h3>
                <p>${desc}</p>
            </div>
        `;

        previewContainer.appendChild(card);

        // reset
        form.reset();
        selectedImage = null;
        selectedPdf = null;
    };

    reader.readAsDataURL(selectedImage);
});