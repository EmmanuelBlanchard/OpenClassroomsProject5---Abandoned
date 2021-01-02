console.log("Hello World ! ");

//const RSS_URL = `https://codepen.io/picks/feed/`;
const RSS_URL = `http://www.lefigaro.fr/rss/figaro_actualites.xml`; 

/*
Blocage d’une requête multiorigines (Cross-Origin Request) : la politique « Same Origin » ne permet pas de consulter 
la ressource distante située sur https://www.lefigaro.fr/rss/figaro_actualites.xml. 
Raison : l’en-tête CORS « Access-Control-Allow-Origin » est manquant
*/

fetch(RSS_URL)
  .then(response => response.text())
  .then(str => new window.DOMParser().parseFromString(str, "text/xml"))
  .then(data => {
    console.log(data);
    const items = data.querySelectorAll("item");
    let html = ``;
    items.forEach(el => {
      html += `
        <article>
          <img src="${el.querySelector("link").innerHTML}/image/large.png" alt="">
          <h2>
            <a href="${el.querySelector("link").innerHTML}" target="_blank" rel="noopener">
              ${el.querySelector("title").innerHTML}
            </a>
          </h2>
        </article>
      `;
    });
    document.body.insertAdjacentHTML("beforeend", html);
  });