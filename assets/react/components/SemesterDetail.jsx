import React, { useState, useEffect } from 'react';
import {getSemester, fetchGroups, getGroup, fetchSubjects, fetchNbGroup,getNbGroup} from '../services/api';
import {Link, useRoute} from 'wouter';

function Semester() {
    const [semester, setSemester] = useState(null);
    const [groups, setGroups] = useState([]);
    const [subjects, setSubjects] = useState([]);
    const [nbGroups, setNbGroups] = useState([]);
    const [, params] = useRoute('/react/semesters/:id');

    useEffect(() => {
        fetchGroups().then((data) => {
            setGroups(data);
            console.log(data)
        });

        fetchNbGroup().then((data) => {
            if (Array.isArray(data['hydra:member'])) {
                setNbGroups(data['hydra:member']);
                console.log(data);
            } else if (Array.isArray(data.nbGroups)) {
                setNbGroups(data.nbGroups);
                console.log(data);
            } else {
                console.error("Data from API is not an array:", data);
            }
            console.log(data)
        });

        fetchSubjects().then((data) => {
            if (Array.isArray(data['hydra:member'])) {
                setSubjects(data['hydra:member']);
                console.log(data)
            } else {
                console.error("Data from API is not an array:", data);
            }
        });

        getSemester(params.id).then((data) => {
            setSemester(data);
        });

    }, [params.id]);

    return (
        <div>
            {semester === null ? 'Loading...' : (
                <div>
                    <ul>
                        {semester.subject && semester.subject.map((subjectObject) => (
                            <li key={subjectObject['@id']} className="semester-li">
                                {subjectObject.subjectCode + ' - ' + subjectObject.name}
                                <br /><br />
                                <div className="groupe-container">
                                    {groups ===null ? 'Aucun Groupe Trouvé' :
                                        groups.map((group) => (
                                                <ul key={group.type}>
                                                    <Link href={`/react/groups/${group.id}`}>
                                                        <li className="groups">
                                                            {group.type} |
                                                            {nbGroups === null
                                                                ? 'Aucun Nombre De Groupe Trouvé'
                                                                : nbGroups
                                                                    .filter((nbGroup) => nbGroup.subject.includes(`/api/subjects/${subjectObject.id}`))
                                                                    .map((filteredNbGroup, index) => (
                                                                        <span>
                                                                            {filteredNbGroup.nbGroup}
                                                                        </span>
                                                                    ))}
                                                        </li>

                                                    </Link>
                                                </ul>
                                            )
                                        )
                                    }
                                </div>
                                <div className="Postuler-container">
                                    <button className="Postuler">Postule</button>
                                </div>
                            </li>
                        ))}
                    </ul>
                </div>
            )}
        </div>
    );
}

// probleme : subject.id = undefined

//{nbGroups === null
 //   ? 'Aucun Nombre De Groupe Trouvé'
//    : nbGroups
//       .filter((nbGroup) =>
//          nbGroup.groupRelation.includes(`/api/groups/${group.id}`) &&
//           nbGroup.subject.includes(`/api/subjects/${subject.id}`)
//       )
//      .map((filteredNbGroup, index) => (
    //         <span key={index}>
//              {filteredNbGroup.nbGroup}
//          </span>
//      ))}


export default Semester;
