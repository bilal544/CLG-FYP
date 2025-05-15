const scriptsLinks = {
    jsPdf: "",
    jsZip: "",
    jsDocx: "",
};

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

export { handleWordCounter, loadScript };
