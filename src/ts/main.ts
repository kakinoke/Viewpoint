//moreボタンの開閉制御
const moreButtons = document.querySelectorAll(".c-button-more");

// カードの制御
const cards = document.querySelectorAll(".u-card");

// 該当のdata属性のカードを取得
const getCard = (dataset: string | null) => {
    if (!dataset) return;
    return Array.from(cards).find(card => {
        return (card as HTMLElement).dataset.card === dataset;
    });
}

moreButtons.forEach((moreButton) => {
    moreButton.addEventListener("click", (event) => {
        event.preventDefault();

        moreButton.classList.toggle("active");

        // data属性の取得
        const buttonDataset = (moreButton as HTMLElement).dataset.card || null;
        const card = getCard(buttonDataset);

        if (!card) return;

        card.classList.toggle("active");
    })
})

// ハンバーガーメニューの開閉
const menu_btn = document.querySelector(".p-nav-mobile__button");
const nav_lines = document.querySelectorAll(".p-nav-mobile__line");
const nav = document.querySelector('.p-nav');
menu_btn?.addEventListener('click', (event) => {
	event.preventDefault();

	nav_lines.forEach((nav_line) => {
		nav_line.classList.toggle("open");
	});

	nav?.classList.toggle("open");
});

// メニューをクリックしたときにハンバーガーメニューを閉じる
const nav_items = document.querySelectorAll('.p-nav__item > a');
nav_items.forEach((nav_item) => {
	nav_item.addEventListener('click', () => {

		nav_lines.forEach((nav_line) => {
			nav_line.classList.remove("open");
		});

		nav?.classList.remove("open");
	});
});


document.addEventListener("DOMContentLoaded", () => {
    // u-scrollクラスを取得
    const scrollElem = document.querySelectorAll("[class*=u-scroll-]");
    if (scrollElem.length === 0) return;

    const createObserver = (threshold: number) =>
        new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // 要素が表示されたら .active クラスを付与
                        entry.target.classList.add("active");
                    }
                });
            },
            {
                root: null, // ビューポートを基準にする
                rootMargin: "0px",
                threshold,
            },
        );

    const observer = createObserver(0.7);
    scrollElem.forEach(elem => {
        observer.observe(elem);
    });
});
