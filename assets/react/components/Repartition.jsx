import React, { useState, useEffect } from 'react';
import "../../styles/repartition.css";
import { Link } from 'wouter';

function Repartition() {

    const [wishes, setWishes] = useState([]);

    const handleDeleteWish = (wishId) => {
        fetch(`/api/wishes/${wishId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then((response) => {
                if (response.ok) {
                    setWishes(wishes.filter((wish) => wish.id !== wishId));
                } else {

                    console.error('Erreur lors de la suppression du souhait');
                }
            })
            .catch((error) => {
                console.error('Erreur réseau lors de la suppression du souhait :', error);
            });
    };

    return (
        <div className="table-container">
            <h2>Répartition de vos heures</h2>
            <table>
                <thead>
                <tr>
                    <th>Cours</th>
                    <th>Section</th>
                    <th>Volume</th>
                    <th>Modification</th>
                    <th>Wish ID</th>
                </tr>
                </thead>
                <tbody>
                {wishes.map((wish) => (
                    <tr key={wish.id}>
                        <td>cours</td>
                        <td>section</td>
                        <td>volume heures</td>
                        <td>
                            <button className="modifier-button">Modifier</button>
                            <button className="supprimer-button" onClick={() => handleDeleteWish(wish.id)}>Supprimer</button>
                        </td>
                        <td>{wish.id}</td>
                    </tr>
                ))}
                </tbody>
            </table>
            <tr>
                <td>
                    <Link to="/react/semesters" className="ajouter-button">Ajouter des heures</Link>
                </td>
            </tr>
        </div>
    );
}

export default Repartition;
