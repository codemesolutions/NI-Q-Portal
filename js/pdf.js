var currentPageIndex = 0;
var pdfInstance = null;
var totalPagesCount = 0;
var viewport

window.initPDFViewer = function(pdfURL, element) {
    pdfjsLib.getDocument(pdfURL).then(function(pdf) {
    pdfInstance = pdf;
    console.log(pdf);
    totalPagesCount = pdf.numPages;
    //initPager();
    viewport = document.querySelector(element)
    render();
  });
};



function render() {
  pdfInstance.getPage(currentPageIndex + 1)
    .then(function(page){
      viewport.innerHTML = `<div><canvas></canvas></div>`
      renderPage(page)
    })
}

function renderPage(page) {
    var pdfViewport = page.getViewport(1);
   
    var container =
      viewport.children[0];
    
     
    // Render at the page size scale.
    pdfViewport = page.getViewport(container.offsetWidth / pdfViewport.width);
    var canvas = container.children[0];
    var context = canvas.getContext("2d");
    canvas.height = pdfViewport.height;
    canvas.width = pdfViewport.width;
    
    console.log();
  
    page.render({
      canvasContext: context,
      viewport: pdfViewport
    });
  }

  function onPagerButtonsClick(event) {
    var action = event.target.getAttribute("data-pager");
    if (action === "prev") {
      if (currentPageIndex === 0) {
        return;
      }
      currentPageIndex -= pageMode;
      if (currentPageIndex < 0) {
        currentPageIndex = 0;
      }
      render();
    }
    if (action === "next") {
      if (currentPageIndex === totalPagesCount - 1) {
        return;
      }
      currentPageIndex += pageMode;
      if (currentPageIndex > totalPagesCount - 1) {
        currentPageIndex = totalPagesCount - 1;
      }
      render();
    }
  }