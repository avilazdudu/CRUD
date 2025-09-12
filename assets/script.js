// Example CSS for alert box (to be added in your CSS file)
const style = document.createElement('style');
style.textContent = `
  .alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
  }
  .alert-error {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
  }
`;
let alert = document.head.appendChild(style);
