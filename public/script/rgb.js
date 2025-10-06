function lightenRGB(rgb, percent = 30) {
  const parts = rgb.match(/\d+/g).map(Number);
  let [r, g, b] = parts;
  r = Math.round(r + (255 - r) * (percent / 100));
  g = Math.round(g + (255 - g) * (percent / 100));
  b = Math.round(b + (255 - b) * (percent / 100));
  return `rgb(${r}, ${g}, ${b})`;
}

document.addEventListener("DOMContentLoaded", () => {
  const root = document.documentElement;
  const primary = getComputedStyle(root)
    .getPropertyValue("--primary-color")
    .trim();
  const primaryLight = lightenRGB(primary, 70);
  root.style.setProperty("--primary-color-light", primaryLight);
});
