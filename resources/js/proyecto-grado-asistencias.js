const modal = document.getElementById('tutorModalContainer');

if (modal) {
    const routeMatch = window.location.pathname.match(/\/proyecto-grado\/([^/]+)\/seguimiento\/?$/);

    if (routeMatch) {
        const projectId = encodeURIComponent(routeMatch[1]);
        const endpoint = `/proyecto-grado/${projectId}`;
        let modalData = null;

        const attendeeTemplate = modal.querySelector('#pillGroup1')?.closest('div.space-y-3');
        const attendeeList = attendeeTemplate?.parentElement;
        const attendeeHeading = attendeeList?.firstElementChild?.cloneNode(true);
        const saveButton = [...modal.querySelectorAll('button')]
            .find((button) => button.textContent.includes('Guardar y Validar'));

        const readFieldContainer = (labelText) => [...modal.querySelectorAll('label')]
            .find((label) => label.textContent.trim().includes(labelText))
            ?.closest('div.flex.flex-col');

        const createField = (type, className, value = '') => {
            const input = document.createElement('input');
            input.type = type;
            input.className = className;
            input.value = value;
            return input;
        };

        const localDate = () => {
            const today = new Date();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            return `${today.getFullYear()}-${month}-${day}`;
        };

        const sessionNumber = readFieldContainer('de Sesión')
            ?.querySelector('span.font-data-mono-bold');
        if (sessionNumber) {
            sessionNumber.dataset.sessionNumber = 'true';
        }

        const dateContainer = readFieldContainer('Fecha Programada')?.querySelector('div');
        const dateDisplay = dateContainer?.querySelector('span.font-data-mono');
        const sessionDate = createField(
            'date',
            dateDisplay?.className ?? 'font-data-mono text-data-mono text-on-surface'
        );
        dateDisplay?.replaceWith(sessionDate);

        const timeContainer = readFieldContainer('Horario')?.querySelector('div');
        const timeDisplay = timeContainer?.querySelector('span.font-data-mono');
        const timeIcon = timeContainer?.querySelector('.material-symbols-outlined');
        const sessionStart = createField(
            'time',
            'font-data-mono text-data-mono text-on-surface bg-transparent focus:outline-none'
        );
        const separator = document.createElement('span');
        separator.textContent = ' - ';
        const sessionEnd = createField(
            'time',
            'font-data-mono text-data-mono text-on-surface bg-transparent focus:outline-none'
        );
        if (timeContainer && timeDisplay) {
            timeContainer.replaceChildren(sessionStart, separator, sessionEnd);
            if (timeIcon) timeContainer.append(timeIcon);
        }

        const topicInput = modal.querySelector('input[type="text"]');
        if (topicInput) {
            topicInput.value = '';
            topicInput.placeholder = 'Tema de la sesión';
        }

        const setSelectedStatus = (group, status) => {
            group.dataset.status = status;
            group.querySelectorAll('button').forEach((button) => {
                const selected = button.dataset.attendanceStatus === status;
                button.setAttribute('aria-pressed', String(selected));
                button.classList.toggle('ring-2', selected);
                button.classList.toggle('ring-primary', selected);
            });
        };

        const renderAttendees = (attendees) => {
            if (!attendeeList || !attendeeTemplate || !attendeeHeading) return;

            const cards = attendees.map((attendee, index) => {
                const card = attendeeTemplate.cloneNode(true);
                const group = card.querySelector('[id^="pillGroup"]');
                const avatar = card.querySelector('.w-8.h-8');
                const name = card.querySelector('span.font-label-lg');
                const details = card.querySelector('span.font-body-sm.text-body-sm.text-outline');
                const fields = card.querySelectorAll('input');

                card.dataset.studentId = attendee.id_estudiante;
                if (group) {
                    group.id = `attendanceGroup${index + 1}`;
                    group.querySelectorAll('button').forEach((button) => {
                        const status = button.textContent.trim().replace(/\s+/g, ' ');
                        const normalizedStatus = [
                            'Presente',
                            'Retraso',
                            'Falta Justificada',
                            'Falta Injustificada',
                        ].find((value) => status.startsWith(value)) ?? 'Presente';
                        button.dataset.attendanceStatus = normalizedStatus;
                        button.addEventListener('click', () => setSelectedStatus(group, normalizedStatus));
                    });
                    setSelectedStatus(group, 'Presente');
                }

                if (avatar) {
                    avatar.textContent = attendee.nombre
                        .split(/\s+/)
                        .filter(Boolean)
                        .slice(0, 2)
                        .map((part) => part[0].toUpperCase())
                        .join('');
                }
                if (name) name.textContent = attendee.nombre;
                if (details) details.textContent = attendee.ci ? `C.I. ${attendee.ci}` : `Código ${attendee.id_estudiante}`;
                if (fields[0]) {
                    fields[0].type = 'time';
                    fields[0].value = '';
                }
                if (fields[1]) fields[1].value = '';
                if (fields[2]) fields[2].value = '';

                return card;
            });

            attendeeList.replaceChildren(attendeeHeading.cloneNode(true), ...cards);
        };

        const renderHistory = (sessions) => {
            const body = modal.querySelector('table tbody');
            if (!body) return;

            const records = sessions.flatMap((session) => (session.asistencias ?? []).map((attendance) => ({
                session,
                attendance,
            })));
            body.replaceChildren();

            if (records.length === 0) {
                const row = document.createElement('tr');
                const cell = document.createElement('td');
                cell.colSpan = 6;
                cell.className = 'py-4 px-3 text-center text-outline';
                cell.textContent = 'Aún no hay sesiones ni asistencias registradas.';
                row.append(cell);
                body.append(row);
                return;
            }

            records.forEach(({ session, attendance }) => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-surface-container-low/40 transition-colors';
                const student = attendance.estudiante;
                const cells = [
                    `Sesión ${String(session.numero_sesion).padStart(2, '0')} · ${session.fecha_programada.slice(0, 10)}`,
                    student
                        ? [student.nombres, student.appaterno, student.apmaterno].filter(Boolean).join(' ')
                        : attendance.id_estudiante,
                    `${session.hora_inicio?.slice(0, 5) ?? '--:--'} → ${attendance.hora_llegada?.slice(0, 5) ?? '--:--'}`,
                    attendance.estado_asistencia,
                    attendance.entregable || session.tema || '—',
                    attendance.validado ? 'Validado' : 'Pendiente',
                ];

                cells.forEach((value, index) => {
                    const cell = document.createElement('td');
                    cell.className = 'py-2.5 px-3';
                    cell.textContent = value;
                    if (index === 5) cell.classList.add('text-right');
                    row.append(cell);
                });
                body.append(row);
            });
        };

        const loadModalData = async () => {
            const response = await fetch(`${endpoint}/sesiones`, {
                headers: { Accept: 'application/json' },
                credentials: 'same-origin',
            });
            if (!response.ok) throw new Error('No se pudieron cargar los datos del proyecto.');

            modalData = await response.json();
            if (sessionNumber) {
                sessionNumber.textContent = `Sesión N° ${modalData.numero_siguiente}`;
            }
            if (sessionDate) {
                sessionDate.value = localDate();
            }
            renderAttendees(modalData.integrantes);
            renderHistory(modalData.sesiones);
        };

        const showError = (message) => {
            if (window.Swal) {
                window.Swal.fire({ icon: 'error', title: 'No se pudo guardar', text: message });
            } else {
                window.alert(message);
            }
        };

        window.salvarAsistencia = async () => {
            if (!modalData) {
                showError('Los datos de integrantes y sesiones no están disponibles. Recargue la página.');
                return;
            }

            const asistencias = [...(attendeeList?.querySelectorAll('[data-student-id]') ?? [])]
                .map((card) => {
                    const fields = card.querySelectorAll('input');
                    const entregable = fields[1]?.value.trim() || null;

                    return {
                        id_estudiante: card.dataset.studentId,
                        estado_asistencia: card.querySelector('[id^="attendanceGroup"]')?.dataset.status ?? 'Presente',
                        hora_llegada: fields[0]?.value || null,
                        entregable,
                        entregable_presentado: Boolean(entregable),
                        observaciones: fields[2]?.value.trim() || null,
                        validado: true,
                    };
                });

            const payload = {
                fecha_programada: sessionDate?.value,
                hora_inicio: sessionStart.value || null,
                hora_fin: sessionEnd.value || null,
                tipo_sesion: 'Ordinaria',
                tema: topicInput?.value.trim() || null,
                asistencias,
            };

            if (!payload.fecha_programada || asistencias.length === 0) {
                showError('Seleccione la fecha y asegúrese de que el proyecto tenga integrantes.');
                return;
            }

            if (saveButton) saveButton.disabled = true;
            try {
                const xsrfToken = document.cookie
                    .split('; ')
                    .find((cookie) => cookie.startsWith('XSRF-TOKEN='))
                    ?.slice('XSRF-TOKEN='.length);
                if (!xsrfToken) {
                    throw new Error('No se encontró el token de seguridad. Recargue la página e inténtelo nuevamente.');
                }
                const response = await fetch(`${endpoint}/sesiones`, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        'X-XSRF-TOKEN': decodeURIComponent(xsrfToken),
                    },
                    body: JSON.stringify(payload),
                });
                const result = await response.json();
                if (!response.ok) {
                    const validationMessage = Object.values(result.errors ?? {}).flat()[0];
                    throw new Error(validationMessage ?? result.message ?? 'Ocurrió un error al guardar.');
                }

                if (window.Swal) {
                    window.Swal.fire({ icon: 'success', title: 'Registro guardado', text: result.message });
                }
                try {
                    await loadModalData();
                } catch (error) {
                    console.error(error);
                    showError('La sesión se guardó, pero no fue posible actualizar el historial. Recargue la página.');
                }
            } catch (error) {
                showError(error.message);
            } finally {
                if (saveButton) saveButton.disabled = false;
            }
        };

        loadModalData().catch((error) => {
            console.error(error);
        });
    }
}
