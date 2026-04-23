function showContent(selector) {
  document.querySelectorAll('[class^="content-"]').forEach(el => el.classList.add('hidden'));
  document.querySelector(selector)?.classList.remove('hidden');
  document.querySelector('aside')?.classList.toggle('translate-x-0');
}