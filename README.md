# volt
PHP Developer Task

1 Metoda handlePayment w serwisie TrafficSplit rozdziela płatności miedzy bramkami płatności według założonych procentów.
2 Metoda działa co potwierdzają testy, im większa próba tym wynik jest bardziej zbliżony do założonego.
3 W danych testowych zwracamy 3 argumenty:
    1 Servis TrafficSplit wraz z Barmkami płatności
    2 tablice z załozonymi powtórzeniami płtności 
    3 tolerancje w procentach na odchył od założonej przepustowosci
        np wartosc odchylenia 5 , sprawia ze testy na bramke która ma przepustowosc 25 beda prawidlowe miedzy 20 (25 - 5) oraz 30 (25+5)