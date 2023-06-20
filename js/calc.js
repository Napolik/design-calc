class customQuiz extends  HTMLElement {
  constructor() {
    super();

    this.blocks = this.querySelectorAll('.quiz__slide');
    this.nextButtons = this.querySelectorAll('.quiz__nav-btn');
    this.startButton = this.querySelector('.js--start');

    this.eventListener();
  }

  eventListener() {

    this.startButton.addEventListener('click' ,(e)=>{
      this.blocks[0].classList.remove('hidden');
      this.startButton.classList.add('hidden');
      this.querySelector('.quiz__subheading').classList.add('hidden');
    });

    this.nextButtons.forEach(button => button.addEventListener('click', (e)=>{
      const currentBlock = e.target.closest('.quiz__slide');

      for (let i = 0; i < this.blocks.length; i++) {
        if (this.blocks[i] === currentBlock) {
          let blockIndex = i + 1;
          let nextBlock = this.blocks[blockIndex];

          this.hideAllBlocks();
          nextBlock.classList.remove('hidden');
          break;
        }
      }
    }));
  }

  hideAllBlocks() {
    this.blocks.forEach(block => block.classList.add('hidden'));
  }

}

customElements.define('custom-quiz', customQuiz);

class sendNotify extends  HTMLElement {
  constructor() {
    super();

    this.form = this.querySelector('form');
    this.inputs = this.querySelectorAll('input');

    this.eventListener();
  }

  eventListener() {
    const _this = this;

    this.form.addEventListener('submit', function(event) {
      const formData = new FormData(this.form);
      const xhr = new XMLHttpRequest();

      event.preventDefault();

        Array.from(_this.inputs).forEach((input) => {
          if (!input.classList.contains('btn')) {
            if (input.type === 'checkbox') {
              if (input.checked) {
                formData.append(input.name, 'Так');
              }
            } else {
              if (input.value !== '') {
                formData.append(input.name, input.value);
              }
            }

          }
        });

      formData.forEach((value, key) => {
        console.log(key + ': ' + value);
      });

        xhr.open('POST', 'send.php', true);
        xhr.onload = function () {
          if (xhr.status === 200 && xhr.responseText !== 'error') {
            console.log('Дані успішно відправлені!');
            _this.querySelectorAll('.js--last-answers').forEach(el => el.classList.add('hidden'));
            _this.querySelector('.quiz__thank-you').classList.remove('hidden');
          } else {
            console.log('Сталася помилка. Спробуйте ще раз.');
          }
        };
        xhr.send(formData);

    });
  }
}

customElements.define('send-notify', sendNotify);