const imageNotFound = `${BASE_URL}/assets/images/not-found.jpg?v=${version}`;

const scriptsLinks = {
    jsPdf: "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js",
    jsDocx: "https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js",
    jsAxios: "https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js",
};

(() => {
    $(document).ready(() => {
        $(document).on("click", ".js-remove-popup", () => {
            $(".js-popup").empty().removeClass("flex").addClass("hidden");
        });
    });
})();

const loadScript = async (scriptKey) => {
    const getScript = scriptsLinks[scriptKey];

    const isExist = Array.from(document.scripts).some(
        (s) => s.src === getScript
    );

    if (isExist) return;

    return new Promise((resolve, reject) => {
        const scriptTag = document.createElement("script");
        scriptTag.src = getScript;
        scriptTag.defer = true;

        scriptTag.onload = () => {
            console.log(`Script loaded: ${getScript}`);
            resolve();
        };

        scriptTag.onerror = () => {
            console.error(`Failed to load script: ${getScript}`);
            reject(new Error(`Script load error: ${getScript}`));
        };

        document.body.appendChild(scriptTag);
    });
};

const handleWordCounter = (text = "") => {
    const words = text.trim().split(/\s+/).filter(Boolean);
    return words.length;
};

const popup = (
    title = "No Text Found!",
    text = "Enter At least 15 words to summarize text."
) => {
    $(".js-popup").empty();
    const $html = `
        <div class="popup-inner bg-white h-auto w-auto shadow rounded-md relative">
      <button type="button" class="flex justify-end w-full cursor-pointer group py-2 px-3 js-remove-popup">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6 text-gray-600 group-hover:text-gray-800 transition-all ease-in duration-200">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
      </button>
      <div class="flex items-center flex-col gap-2.5 py-5 px-4">
        <img src="${imageNotFound}" alt="img-not-found"
          class="h-[200px] w-[200px] object-cover mix-blend-multiply">
        <h2 class="text-red-600 text-4xl/7 font-semibold text-center">
          ${title}
        </h2>
        <p class="text-gray-600 text-lg/6 font-normal text-center">
          ${text}
        </p>
      </div>
    </div>
    `;

    $(".js-popup").html($html).removeClass("hidden").addClass("flex");
};

const handleCopyResult = (e) => {
    const targetText = $(e.currentTarget).data("copy");
    $(e.currentTarget).attr("data-tooltip", "Copied!");

    if (targetText) {
        navigator.clipboard
            .writeText(targetText)
            .then(() => {
                setTimeout(() => {
                    $(e.currentTarget).attr("data-tooltip", "Copy");
                }, 1500);
            })
            .catch((error) => {
                console.error("No text copied:", error);
            });
    }
};

const handleDownloadResult = (e) => {
    const targetText = $(e.currentTarget).data("download");
    $(e.currentTarget).attr("data-tooltip", "Downloading...");
    if (targetText) {
        const blob = new Blob([targetText], { type: "text/plain" });
        const url = URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.href = url;
        a.download = "summarize.txt";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);

        URL.revokeObjectURL(url);
        $(e.currentTarget).attr("data-tooltip", "Download");
    }
};

// get file extension
const handleFileExtension = (fileName = "testing.txt") => {
    const fileExt = fileName?.split(".")?.pop()?.toLowerCase();
    if (fileExt) {
        return fileExt;
    } else {
        console.log("file name not found.");
    }
};

// extract text from pdf file
const handleExtractTextFromPdf = (file) => {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();

        reader.onload = async (event) => {
            try {
                await loadScript("jsPdf");
                const typedArray = new Uint8Array(event.target.result);
                const loadingTask = pdfjsLib.getDocument({ data: typedArray });

                const pdf = await loadingTask.promise;
                let fullText = "";

                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const content = await page.getTextContent();

                    const lines = {};
                    content.items.forEach((item) => {
                        const y = item.transform[5];
                        if (!lines[y]) lines[y] = [];
                        lines[y].push(item.str);
                    });

                    const sortedY = Object.keys(lines)
                        .map(Number)
                        .sort((a, b) => b - a);

                    sortedY.forEach((y) => {
                        fullText += lines[y].join(" ") + "\n";
                    });

                    fullText += "\n";
                }

                const words = fullText?.split(/\s+/).filter(Boolean);
                const result = words.slice(0, 500).join(" ");
                resolve(result);
            } catch (err) {
                console.error("Error reading PDF:", err);
                reject(err);
            }
        };

        reader.readAsArrayBuffer(file);
    });
};

// extract text from .docx file
const handleExtractTextFromDocx = async (file) => {
    await loadScript("jsDocx"); // make sure this loads mammoth.js

    return new Promise((resolve, reject) => {
        const reader = new FileReader();

        reader.onload = (e) => {
            const arrayBuffer = e.target.result;

            mammoth
                .extractRawText({ arrayBuffer })
                .then((result) => {
                    const fullText = result.value;
                    const first500Words = fullText
                        .split(/\s+/)
                        .filter(Boolean)
                        .slice(0, 500)
                        .join(" ");

                    resolve(first500Words); // you can return fullText if needed
                })
                .catch((err) => {
                    console.error("Error reading DOCX:", err);
                    reject(err);
                });
        };

        reader.readAsArrayBuffer(file);
    });
};

export {
    handleWordCounter,
    loadScript,
    popup,
    handleCopyResult,
    handleDownloadResult,
    handleFileExtension,
    handleExtractTextFromPdf,
    handleExtractTextFromDocx,
};
