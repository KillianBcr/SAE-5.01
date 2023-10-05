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

    useEffect(() => {
        fetch('/api/user/wishes', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Erreur lors de la récupération des souhaits');
                }
            })
            .then((data) => {
                setWishes(data);
            })
            .catch((error) => {
                console.error('Erreur lors de la récupération des souhaits :', error);
            });
    }, []);

    return (
        <div className="table-container">
            <h2>Répartition de vos heures</h2>
            <table>
                <thead>
                <tr>
                    <th>Wish ID</th>
                    <th>Volume</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {wishes.map((wish) => (
                    <tr key={wish.id}>
                        <td>{wish.id}</td>
                        <td>{wish.subject.hoursTotal}</td>
                        <td>
                            <button className="modifier-button">Modifier</button>
                            <button className="supprimer-button" onClick={() => handleDeleteWish(wish.id)}>Supprimer</button>
                        </td>
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
