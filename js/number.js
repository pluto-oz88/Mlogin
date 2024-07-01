const number = document.querySelector("#mobile");
const text1 = document.querySelector("#text1");
const text2 = document.querySelector("#text2");

let regex = /^\+(?:[0-9] ?){6,14}[0-9]$/;

number.addEventListener("input", (event) => {
  const allowed = "0123456789+() ";
  const last = number.value.charAt(number.value.length - 1);
  if (allowed.indexOf(last) == -1) {
    number.value = number.value.slice(0, -1);
  }
  text1.innerText = "(" + number.value.length + " digits)";
  if (number.value.length < 9) {
    text1.style.color = "#da3400";
  } else {
    text1.style.color = "rgba(4,125,9,1)";
  }
  // if (number.value.match(regex)) {
  if (number.value[0] == "+" && number.value[1] != 0) {
    text2.innerText = "Correct number format";
    text2.style.color = "rgba(4,125,9,1)";
  } else {
    text2.innerText = "Incorrect number format";
    text2.style.color = "#da3400";
  }
});
