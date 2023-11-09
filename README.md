# volt
PHP Developer Task

## 1 Metoda handlePayment w serwisie TrafficSplit rozdziela płatności między bramkami płatności według założonych procentów,
##    które są skonfigurowane w poszczególnych bramkach płatności.
##    (Konfiguracje można również, przenieść do odzielnego pliku w strukturze ['nazwa_bramki' => 'procent_obciążenia'])
## 2 Metoda działa, co potwierdzają testy, im większa próba, tym wynik jest bardziej zbliżony do założonego.
## 3 W danych testowych zwracamy 3 argumenty:
###    1 Servis TrafficSplit wraz z bramkami płatności
###    2 Tablice z ilością testowych płatności 
###    3 Tolerancje w procentach na odchylenie od założonej przepustowości
###     np. wartość odchylenia 5 , sprawia, że testy na bramkę, która ma przepustowość 25 będą prawidłowe między 20 (25 - 5) oraz 30 (25+5)