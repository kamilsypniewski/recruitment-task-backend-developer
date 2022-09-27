# Zadanie rekrutacyjne na stanowisko Backend Developer w DobryMechanik.pl

## Instalacja i uruchomienie

1. `git clone git@github.com:dobrymechanik/recruitment-task-backend-developer.git`
2. `cd recruitment-task-backend-developer`
3. `git checkout mid`
4. sprawdź czy masz wolny port 8888 lub ustaw inny wolny port w HTTP_PORT w pliku .env
5. `make up`
6. http://localhost:{HTTP_PORT}/

## Zadanie

- wykorzystaj [API NYTimes](https://developer.nytimes.com/get-started)
- pod adresem http://localhost:{HTTP_PORT}/nytimes/
- wyświetl listę 10 najnowszych artykułów na temat motoryzacji - wykorzystaj [Article Search](https://developer.nytimes.com/docs/articlesearch-product/1/overview)
- opis struktury odpowiedzi API znajdziesz [tutaj](https://developer.nytimes.com/docs/articlesearch-product/1/routes/articlesearch.json/get)
- listę zaprezentuj w formie następującego JSONa:

```json
[
  {
    "title": "dane pobierz z response.docs[].headline.main",
    "publicationDate": "dane pobierz z response.docs[].pub_date",
    "lead": "dane pobierz z response.docs[].lead_paragraph",
    "image": "dane pobierz z response.docs[].multimedia.subtype=\"superJumbo\"",
    "url" : "dane pobierz z response.docs[].web_url"
  }
]
```

# Mile widzialne

- wykorzystanie tylko komponentów Symfony
- stworzenie minimalnego zestawu testów jednostkowych

# Tips

- Makefile zawiera kilka komend przydatnych w pracy z dockerem
- `make test` - uruchomi PHPUnit w kontenerze PHP
