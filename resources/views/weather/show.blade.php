<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>天気予報</title>
</head>
<body>
  <h1>1週間の天気予報</h1>

  @if ($weather)
    <ul>
      @foreach ($weather['list'] as $day)
        <li>
          日付：{{ date('Y-m-d', $day['dt']) }}<br>
          天気：{{ $day['weather'][0]['description'] }}<br>
          最高気温：{{ $day['main']['temp_max'] }}℃<br>
          最低気温：{{ $day['main']['temp_min'] }}℃
        </li>
      @endforeach
    </ul>
  @else
    <p>天気情報を取得できませんでした。</p>
  @endif
</body>
</html>
