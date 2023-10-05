import React, { useState, useEffect } from 'react';
import { getSemester } from '../services/api';
import { useRoute } from 'wouter';

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
                        {semester.subject && semester.subject.map((subject) => (
                            <li key={subject['@id']} className="semester-li">
                                {subject.subjectCode + ' - ' + subject.name}
                                <br /><br />
                                <div className="groupe-container">
                                    {subject.nbGroups.map((nbGroup) => (
                                        <li key={nbGroup.id} className="groupe">
                                            {`Groupe ${nbGroup.group.lib} | Matière: ${subject.name} | Nombre de groupes: ${nbGroup.nb_group}`}
                                        </li>
                                    ))}
                                </div>
                                <div className="Postuler-container">
                                    <button className="Postuler">Postuler</button>
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
