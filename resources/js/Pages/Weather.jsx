import React, { useState } from 'react';

const Weather = () => {
  const [weather, setWeather] = useState(null);
  const [error, setError] = useState(null);
  const [loading, setLoading] = useState(false);

  const getWeather = () => {
    setLoading(true);

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition((position) => {
        const { latitude, longitude } = position.coords;

        fetch(`/api/weather?lat=${latitude}&lon=${longitude}`)
          .then(response => {
            setLoading(false);
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(data => {
            setWeather(data);
            console.log(data);

          })
          .catch(err => {
            setError(err.message);
          });
      },
      (err) => {
        setLoading(false);
        setError(err.message);
      });
    } else {
      setLoading(false);
      setError('Geolocation is not supported by this browser.');
    }
  };

  return (
    <div>
      <h1>1週間の天気予報</h1>
      <button onClick={getWeather} disabled={loading}>
        {loading ? 'Loading...' : 'Get Current Weather'}
      </button>
      { error && <p>Error: {error}</p>}
      { weather && <h2>{weather.city.name}</h2>}
      { weather ? (
        <ul>
          {weather.list.map((day, index) => (
            <li key={index}>
              {/* 日付: {new Date(day.dt * 1000).toLocaleDateString()}<br /> */}
              日付: {day.dt_txt}<br />
              天気: {day.weather[0].description}<br />
              最高気温: {day.main.temp_max}℃<br />
              最低気温: {day.main.temp_min}℃
            </li>
          ))}
        </ul>
      ) : (
        <p>天気情報を読み込んでいます...</p>
      )}
    </div>
  )
}

export default Weather;
