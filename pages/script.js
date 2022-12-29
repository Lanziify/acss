const randomNumber = () => {
  return Math.floor(Math.random() * 360);
};

const randomScheme = () => {
  const schemes = ["mono", "contrast", "triade", "tetrade", "analogic"];
  const randomSchemeIndex = Math.floor(Math.random() * schemes.length);
  return schemes[randomSchemeIndex];
};

const randomVariation = () => {
  const variations = ["pastel", "soft", "light", "hard", "pale"];
  const randomVariationIndex = Math.floor(Math.random() * variations.length);
  return variations[randomVariationIndex];
};

var schemeType = "";

function generatePallete() {
  var scheme = new ColorScheme();
  var hue_value = randomNumber();

  scheme
    .from_hue(hue_value)
    .scheme(randomScheme())
    .distance(0.35)
    .variation(randomVariation());
  schemeType = scheme.scheme();
  return (color = scheme.colors());
}

function generateColors() {
  for (let i = 1; i <= palette_container; i++) {
    let elements = document.getElementsByClassName(`palette-${i}`);
    let color = generatePallete();
    let color_temp = [];

    for (let j = 0; j < color.length; j++) {
      if (schemeType == "mono") {
        color_temp.push(color[j]);
      } else if (schemeType === "contrast") {
        color_temp = [0, 3, 4].map((j) => color[j]);
        color_temp.push(color[j]);
      } else if (schemeType === "triade") {
        if (j % 4 == 0) {
          color_temp.push(color[j]);
        }
        if (j === 8) {
          color_temp.push(color[j + 3]);
          break;
        }
      } else if (schemeType === "tetrade") {
        if (j % 4 == 0) {
          color_temp.push(color[j]);
        }
      } else {
        if (j % 4 == 0) {
          color_temp.push(color[j]);
        }
        if (j === 8) {
          color_temp.push(color[j + 3]);
          break;
        }
      }
    }

    for (let element of elements) {
      const elements = document.querySelectorAll(`.color-${i}`);
      for (let x = 0; x < elements.length; x++) {
        elements[x].style.backgroundColor = `#${color_temp[x]}`;
        elements[x].innerText = `#${color_temp[x]}`;
      }
      color_temp.length = 0;
    }
  }
}

const palette_container = 100;

function generateBlocks() {
  for (var i = 0; i < palette_container; i++) {
    const palette_wrapper = document.createElement("div");
    palette_wrapper.classList.add("palette-wrapper", `palette-${i + 1}`);
    document.querySelector(".main-page-content").appendChild(palette_wrapper);
    for (var j = 0; j < 4; j++) {
      const color_block = document.createElement("div");
      color_block.classList.add("color-block", "color-" + [i + 1]);
      palette_wrapper.appendChild(color_block);
    }
  }
  generateColors();
}

window.onload = function () {
  if (document.querySelector(".main-page-content")) {
    // the div is present, so run the function
    generateBlocks();
  }
};

function generateColorPalette() {
  var div = document.querySelector(".palette");
  div.classList.add('visible')
  if (div.classList.contains("palette-1")) {
    generateColors();
  } else {
    div.classList.add("palette-1");
  }
  generateColors();
}
