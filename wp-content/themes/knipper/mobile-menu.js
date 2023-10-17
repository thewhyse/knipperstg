document.querySelectorAll(".mega-menu").forEach(md => md.addEventListener('mouseover', () => {
    md.querySelector(".sub-menu").classList.toggle('active');
  }));