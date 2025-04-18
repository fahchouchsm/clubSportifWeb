window.addEventListener("DOMContentLoaded", () => {
  const inputs = document.querySelectorAll('input[type="text"]');
  inputs.forEach((input) => {
    input.classList.add(
      "block",
      "w-full",
      "rounded-lg",
      "border-2",
      "border-gray-300",
      "p-2",
      "focus:border-blue-500",
      "focus:outline-none",
    );
  });
});
