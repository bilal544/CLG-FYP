import {
    getIp,
    handleCopyResult,
    handleDownloadResult,
    handleWordCounter,
    loadScript,
    popup,
} from "./general.js";

const sampleText = "Twinkle Twinkle Little Star";
const $targetElem = $("#input-topic-name");
const API_BASE_URL = `/paraphrase/generate-essay`;
let IP_ADDRESS;
(() => {
    $(document).ready(() => {
        $("#input-topic-name").on("change input paste", handleInput);
        $("#js-sample-text").on("click", handleSampleText);
        $("#js-ai-essay-writer").on("submit", handleSubmit);
        $("#js-delete-result-text").on("click", handleReset);
        $("#js-copy-result-text").on("click", handleCopyResult);
        $("#js-download-result-text").on("click", handleDownloadResult);
        (async () => {
            IP_ADDRESS = await getIp();
        })();
    });

    // handle reset to initial state
    const handleReset = () => {
        $(".js-output-body").empty();
        $("#js-copy-result-text").attr("data-copy", "");
        $("#js-download-result-text").attr("data-download", "");
        $(".js-essaywriter-output").addClass("hidden").removeClass("block");
        $($targetElem).val("");
        handleInput({ target: $("#input-topic-name")[0] });
    };

    // handle input`
    const handleInput = (e) => {
        const { value } = e.target;
        const trimText = value.trim();
        if (trimText) {
            $("#js-sample-text").addClass("hidden").removeClass("block");
            return;
        }

        $("#js-sample-text").removeClass("hidden").addClass("block");
    };

    // handle sample text
    const handleSampleText = () => {
        $targetElem.val(sampleText);
        handleInput({ target: $("#input-topic-name")[0] });
    };

    // handle submit function
    const handleSubmit = async (e) => {
        e.preventDefault();
        const $length = $('[name="essay_length"]:checked').val();
        const text = $($targetElem).val().trim();
        if (!text) {
            popup("Invalid Topic", "Please type essay topic.");
            return;
        }
        $("#submit")
            .val("Generating...")
            .addClass("pointer-events-none bg-[#007aff]/90")
            .removeClass("cursor-pointer bg-[#007aff]");
        await loadScript("jsAxios");
        const payload = {
            text: text,
            essay_length: $length,
            IP_ADDRESS,
        };

        try {
            const response = await axios.post(API_BASE_URL, payload, {
                headers: {
                    "content-type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
                },
            });

            const data =
                response?.data?.essay ||
                "The pipe symbol is a vertical bar (|). It's also known as a vertical line, vertical slash, or upright slash, and is used in various contexts like mathematics, computing, and typography. In programming, it can represent a logical OR operator or be used to redirect output from one command to another";
            if (!data) {
                $("#submit")
                    .val("Generate Essay")
                    .removeClass("pointer-events-none bg-[#007aff]/90")
                    .addClass("cursor-pointer bg-[#007aff]");
                popup("Error", "Something went wrong!");
                return;
            }
            const totalWords = handleWordCounter(data);
            $(".js-output-body").html(data);
            $("#submit")
                .val("Generate Essay")
                .removeClass("pointer-events-none bg-[#007aff]/90")
                .addClass("cursor-pointer bg-[#007aff]");
            $("#js-copy-result-text").attr("data-copy", data);
            $("#js-download-result-text").attr("data-download", data);
            $(".js-output-words").text(`${totalWords} Words`);
            $(".js-essaywriter-output").removeClass("hidden").addClass("block");
            $(".js-essaywriter-output")[0].scrollIntoView({
                behaviour: "smooth",
            });
        } catch (error) {
            console.error("api error", error?.message);
        } finally {
            $("#submit")
                .val("Generate Essay")
                .removeClass("pointer-events-none bg-[#007aff]/90")
                .addClass("cursor-pointer bg-[#007aff]");
        }
    };
})();
