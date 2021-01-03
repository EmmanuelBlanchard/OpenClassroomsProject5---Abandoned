
console.log('fichier rss.js');
/*
fetch(websiteUrl).then((res) => {
    res.text().then((htmlTxt) => {
      var domParser = new DOMParser()
      let doc = domParser.parseFromString(htmlTxt, 'text/html')
      var feedUrl = doc.querySelector('link[type="application/rss+xml"]').href
    })
  }).catch(() => console.error('Error in fetching the website'))
*/
/*
fetch('https://www.lefigaro.fr/').then((res) => {
    res.text().then((htmlTxt) => {
      var domParser = new DOMParser()
      let doc = domParser.parseFromString(htmlTxt, 'text/html')
      var feedUrl = doc.querySelector('link[type="application/rss+xml"]').href
    })
  }).catch(() => console.error('Error in fetching the website'))

  */
/*
Blocage d’une requête multiorigines (Cross-Origin Request) : la politique « Same Origin » ne permet pas de consulter 
la ressource distante située sur https://www.lefigaro.fr/. 
Raison : l’en-tête CORS « Access-Control-Allow-Origin » est manquant.
*/
/*
fetch(feedUrl).then((res) => {
res.text().then((xmlTxt) => {
    var domParser = new DOMParser()
    let doc = domParser.parseFromString(xmlTxt, 'text/xml')
    doc.querySelectorAll('item').forEach((item) => {
        let h1 = document.createElement('h1')
        h1.textContent = item.querySelector('title').textContent
        document.querySelector('output').appendChild(h1)
        })
    })
})
*/
const xhr = new XMLHttpRequest()
const method = "GET"
const url = "https://developer.mozilla.org/"

xhr.open(method, url, true)
xhr.onreadystatechange = () => {
  if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    console.log(xhr.responseText)
  }
}
xhr.send()


