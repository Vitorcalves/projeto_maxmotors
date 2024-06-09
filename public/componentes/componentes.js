class ThemeToggle extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                <symbol id="check2" viewBox="0 0 16 16">
                    <path
                    d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"
                    />
                </symbol>
                <symbol id="circle-half" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
                </symbol>
                <symbol id="moon-stars-fill" viewBox="0 0 16 16">
                    <path
                    d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"
                    />
                    <path
                    d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"
                    />
                </symbol>
                <symbol id="sun-fill" viewBox="0 0 16 16">
                    <path
                    d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"
                    />
                </symbol>
            </svg>
            <div
                class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle"
            >
                <button
                class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
                id="bd-theme"
                type="button"
                aria-expanded="false"
                data-bs-toggle="dropdown"
                aria-label="Toggle theme (auto)"
                >
                <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                    <use href="#circle-half"></use>
                </svg>
                <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
                </button>
                <ul
                class="dropdown-menu dropdown-menu-end shadow"
                aria-labelledby="bd-theme-text"
                >
                <li>
                    <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="light"
                    aria-pressed="false"
                    >
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                    </button>
                </li>
                <li>
                    <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="dark"
                    aria-pressed="false"
                    >
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                    </button>
                </li>
                <li>
                    <button
                    type="button"
                    class="dropdown-item d-flex align-items-center active"
                    data-bs-theme-value="auto"
                    aria-pressed="true"
                    >
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                    </button>
                </li>
                </ul>
            </div>
        `;
        this.initThemeToggle();
    }
    initThemeToggle() {
        const themeButtons = this.querySelectorAll('[data-bs-theme-value]');
    
        themeButtons.forEach((btn) => {
          btn.addEventListener('click', () => {
            const theme = btn.getAttribute('data-bs-theme-value');
            if (theme === 'light') {
              document.documentElement.setAttribute('data-bs-theme', 'light');
            } else if (theme === 'dark') {
              document.documentElement.setAttribute('data-bs-theme', 'dark');
            } else {
              document.documentElement.removeAttribute('data-bs-theme');
            }
          });
        });
      }
}
class CabecarioPagina extends HTMLElement {
    constructor() {
        super();
        this._menus = [];
    }

    set menus(value) {
        this._menus = value;
        this.renderMenu();
    }

    renderMenu() {
        const menuItensHtml = this._menus.map((menu) => {
            return `<li class="nav-item">
                <a href="${menu.url}" class="nav-link">${menu.nome}</a>
            </li>`;
        }
        ).join('');

        this.innerHTML = `
            <header data-bs-theme="dark">
                <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarMenu">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">Menu</h5>
                        <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Fechar"
                        ></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            ${menuItensHtml}
                        </ul>
                    </div>
                </div>
                <div class="navbar navbar-dark bg-dark shadow-sm">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between">
                            <button
                                class="navbar-toggler me-0"
                                type="button"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#navbarMenu"
                                aria-controls="navbarMenu"
                                aria-expanded="false"
                                aria-label="Menu"
                            >
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <a
                                href="#"
                                class="navbar-brand ms-4 me-2 d-flex align-items-center nome-empresa"
                            >
                                <strong>Max Motors </strong>
                            </a>
                            <p
                                class="text-white mb-0 d-flex align-items-center"
                                style="font-family: Uni Sans Heavy, sans-serif"
                            >
                                O lugar certo para comprar seu carro
                            </p>
                        </div>
                    </div>
                </div>
            </header>
        `;
    }
}

class RodapePagina extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <footer class="text-body-secondary py-5">
        <div class="container">
          <p class="float-end mb-1">
            <a href="#">Back to top</a>
          </p>
          <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
          <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="../getting-started/introduction/">getting started guide</a>.</p>
        `;
    }
}

class CompSelect extends HTMLElement {
    constructor() {
        super();
        this._select = {
            options: [],
            name: '',
            idField: 'id',
            textField: 'text',
            selectedValue: null,
            extra: null
        };
    }

    set select(value) {
        this._select = {...this._select, ...value};
        this.renderSelect();
    }

    renderSelect() {
        let options = this._select.options.map(option => {
            let isSelected = this._select.selectedValue === option[this._select.idField] ? 'selected' : '';
            return `<option value="${option[this._select.idField]}" ${isSelected}>${option[this._select.textField]}</option>`;
        }).join('');

        if (this._select.extra) {
            let isExtraSelected = this._select.selectedValue === this._select.extra.id ? 'selected' : '';
            options = `<option value="${this._select.extra.id}" ${isExtraSelected}>${this._select.extra.name}</option>` + options;
        }
        
        this.innerHTML = `
            <label for="${this._select.name}" class="form-label">${this._select.name}</label>
            <select name="${this._select.name}" id="${this._select.name}" class="form-select">
                ${options}
            </select>
        `;
    }
}

class CompToast extends HTMLElement {
    constructor() {
        super();
        this._toast = {
            message: '',
            type: 'success' // 'success' ou 'error'
        };
    }

    set toast(value) {
        this._toast = {...this._toast, ...value};
        this.renderToast();
    }

    renderToast() {
        const toastHTML = `
            <div class="toast-container position-fixed top-0 end-0">
                <div class="toast align-items-center text-bg-${this._toast.type} border-0 fade show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            ${this._toast.message} 
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        `;

        this.innerHTML = toastHTML;
        this.show();
    }

    show() {
        const toastElem = this.querySelector('.toast');
        toastElem.style.opacity = 1;
        setTimeout(() => {
            toastElem.style.opacity = 0;
            this.remove();
        }, 4000);
    }
}

customElements.define('cabecario-pagina', CabecarioPagina);
customElements.define('rodape-pagina', RodapePagina);
customElements.define('theme-toggle', ThemeToggle);
customElements.define('comp-select', CompSelect);
customElements.define('comp-toast', CompToast);
