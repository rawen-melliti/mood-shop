document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('mouseover', () => {
    card.style.boxShadow = "0 10px 30px rgba(0,0,0,0.5)";
  });
});