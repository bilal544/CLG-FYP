import { handleWordCounter } from "./general.js";

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
    });

    // handle input when user type text in textarea
    const handleInputTextArea = (e) => {
        const { value } = e.target;
        const trimText = value.trim();
        const words = handleWordCounter(trimText);
        if (trimText) {
            $("#js-btn-group").removeClass("flex").addClass("hidden");
            $("#js-delete-text").removeClass("hidden").addClass("block");
            $(".js-entered-words").text(words);
        } else {
            $("#js-btn-group").removeClass("hidden").addClass("flex");
            $("#js-delete-text").removeClass("block").addClass("hidden");
            $(".js-entered-words").text(0);
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
})();
