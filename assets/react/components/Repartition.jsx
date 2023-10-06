import React, { useState, useEffect } from 'react';
import "../../styles/repartition.css";
import { Link } from 'wouter';
import {fetchSemesters, fetchWishes} from "../services/api";

function Repartition() {
    const [wishes, setWishes] = useState([]);

    useEffect(() => {
        fetchWishes().then((data) => {
            setWishes(data["hydra:member"]);
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
                        <td>{wish.subjectId.hoursTotal}</td>
                        <td>
                            <button className="modifier-button">Modifier</button>
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
