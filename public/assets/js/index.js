import {
    handleCopyResult,
    handleDownloadResult,
    handleWordCounter,
    loadScript,
    popup,
} from "./general.js";

const API_BASE_URL = "https://jsonplaceholder.typicode.com/";
const MAX_WORDS = 500;
const MIN_WORDS = 15;
const sampleText =
    "Put what you want changed in this section. Then, click the paraphrase button below. It's that easy!";

(() => {
    $(document).ready(() => {
        $("#js-input-text").on(
            "change, input, keyup, keydown",
            handleInputTextArea
        );
        $("#js-input-text").on("paste", (e) => {
            setTimeout(() => {
                handleInputTextArea(e);
            }, 0);
        });
        $("#js-sample-text").on("click", handleSampleText);
        $("#js-delete-text").on("click", handleDeleteText);
        $("#js-paste-text").on("click", handlePasteText);
        $(".js-text-summarize").on("click", handleSummarize);
        $(document).on("click", "#js-delete-result-text", handleClearAll);
        $(document).on("click", "#js-copy-result-text", handleCopyResult);
        $(document).on(
            "click",
            "#js-download-result-text",
            handleDownloadResult
        );
    });

    // handle input when user type text in textarea
    const handleInputTextArea = (e) => {
        const { value } = e.target;
        const trimText = value.trim();
        const words = handleWordCounter(trimText);
        if (trimText) {
            $("#js-btn-group").removeClass("flex").addClass("hidden");
            $("#js-delete-text").removeClass("hidden").addClass("block");
            $(".js-entered-words")
                .text(words)
                .removeClass("text-red-600 text-gray-600")
                .addClass("text-gray-600");
            if (words > MAX_WORDS) {
                popup(
                    "Text Too Long!",
                    "Only 500 words are accepted to summarize."
                );
                $(".js-entered-words")
                    .addClass("text-red-600")
                    .removeClass("text-gray-600");
                return;
            }
        } else {
            $("#js-btn-group").removeClass("hidden").addClass("flex");
            $("#js-delete-text").removeClass("block").addClass("hidden");
            $(".js-entered-words")
                .text(0)
                .removeClass("text-red-600 text-gray-600")
                .addClass("text-gray-600");
        }
    };

    // try sample text
    const handleSampleText = () => {
        $("#js-input-text").val(sampleText);
        handleInputTextArea({ target: $("#js-input-text")[0] });
    };

    // delete text
    const handleDeleteText = () => {
        $("#js-input-text").val("");
        handleInputTextArea({ target: $("#js-input-text")[0] });
    };

    // paste text
    const handlePasteText = () => {
        navigator.clipboard
            .readText()
            .then((pastedText) => {
                $("#js-input-text").val(pastedText);
                handleInputTextArea({ target: $("#js-input-text")[0] });
            })
            .catch((err) => {
                console.error("Failed to read clipboard: ", err);
            });
    };

    // handle summarize text
    const handleSummarize = async () => {
        const btnText = $(".js-text-summarize").text();
        const inputText = $("#js-input-text").val().trim() || "";
        const words = handleWordCounter(inputText);

        if (inputText == "" || words < MIN_WORDS) {
            popup();
            return;
        }

        if (words > MAX_WORDS) {
            popup(
                "Text Too Long!",
                "Only 500 words are accepted to summarize."
            );
            return;
        }

        // load axios script
        await loadScript("jsAxios");
        $(".js-text-summarize")
            .text("Summarizing...")
            .addClass("pointer-events-none bg-[#131313]/50")
            .removeClass("cursor-pointer");
        $(".js-result-show").addClass("hidden");
        $(".js-loader").addClass("flex").removeClass("hidden");
        $(".js-output-bottom").addClass("hidden").removeClass("flex");
        try {
            const response = await axios.post(
                `${API_BASE_URL}/posts`,
                {
                    text: inputText,
                },
                {
                    headers: {
                        "content-type": "application/json",
                    },
                }
            );

            if (response) {
                $(".js-loader").removeClass("flex").addClass("hidden");
                const resultText = response?.data?.text || "No result found.";
                const outputWords = handleWordCounter(resultText.trim());
                $(".js-output-bottom").removeClass("hidden").addClass("flex");
                $("#js-result-text").val(resultText);
                $(".js-output-words").text(outputWords);
                $(".js-result-show").removeClass("hidden");
                $(".js-text-summarize")
                    .text(btnText)
                    .removeClass("pointer-events-none bg-[#131313]/50")
                    .addClass(
                        "cursor-pointer pointer-events-auto bg-[#131313]"
                    );
                $("#js-download-result-text").attr("data-download", resultText);
                $("#js-copy-result-text").attr("data-copy", resultText);
            }
        } catch (error) {
        } finally {
            $(".js-loader").removeClass("flex").addClass("hidden");
        }
    };

    // handle clear all
    const handleClearAll = () => {
        $(".js-output-bottom").addClass("hidden").removeClass("flex");
        $("#js-result-text").val("");
        handleDeleteText();
    };
})();
