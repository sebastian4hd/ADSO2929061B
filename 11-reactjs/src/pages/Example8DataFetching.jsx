import React from 'react';
import { Link } from 'react-router-dom';
import './Example8DataFetching.css';

function Example8DataFetching() {
  return (
    <div className="example8-page">
      <div className="example8-card">
        <h1>08 - Data Fetching</h1>
        <p>Este ejercicio aún no está implementado en la ruta actual.</p>
        <p>Haz clic en Challenge para ver la aplicación de mascotas.</p>
        <Link to="/" className="example8-back-link">Volver al menú</Link>
      </div>
    </div>
  );
}

export default Example8DataFetching;
