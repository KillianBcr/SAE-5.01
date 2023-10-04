import React, {useState, useEffect} from 'react';
import {getSemester} from '../services/api';
import {Link, useRoute} from 'wouter';
import Modal from 'react-modal';

function Semester() {
    const [semester, setSemester] = useState(null);
    const [, params] = useRoute('/react/semesters/:id');

    useEffect(() => {
        getSemester(params.id).then((data) => {
            setSemester(data);


        });
    }, [params.id]);

    return (
        <div>
            {semester === null ? 'Loading...' : (
                <div>
                    <ul>
                        {semester.subject.map((subject) => (
                            <li key={subject['@id']} className="semester-li">
                                {subject.subjectCode + ' - ' + subject.name}
                                <br/><br/>
                                <p className="groupe">Groupes |</p>
                                <div className="Postuler-container">
                                    <a href="/wish/new" className="ajouter-button">Postuler</a>
                                </div>
                            </li>
                        ))}
                    </ul>
                </div>
            )}
        </div>
    );
}

export default Semester;
