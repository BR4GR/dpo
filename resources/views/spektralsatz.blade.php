@extends('layouts.app')

@section('content')
    <div class="container article">
<pre>
.------------------------------------------------------------------------------------------------------.
|                                                                                                      |
|  ███████╗██████╗ ███████╗██╗  ██╗████████╗██████╗  █████╗ ██╗     ███████╗ █████╗ ████████╗███████╗  |
|  ██╔════╝██╔══██╗██╔════╝██║ ██╔╝╚══██╔══╝██╔══██╗██╔══██╗██║     ██╔════╝██╔══██╗╚══██╔══╝╚══███╔╝  |
|  ███████╗██████╔╝█████╗  █████╔╝    ██║   ██████╔╝███████║██║     ███████╗███████║   ██║     ███╔╝   |
|  ╚════██║██╔═══╝ ██╔══╝  ██╔═██╗    ██║   ██╔══██╗██╔══██║██║     ╚════██║██╔══██║   ██║    ███╔╝    |
|  ███████║██║     ███████╗██║  ██╗   ██║   ██║  ██║██║  ██║███████╗███████║██║  ██║   ██║   ███████╗  |
|  ╚══════╝╚═╝     ╚══════╝╚═╝  ╚═╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝  |
|                                                                                                      |
'------------------------------------------------------------------------------------------------------'

</pre>
        <p>
            Der <strong>Spektralsatz für symmetrische Matrizen</strong> ist ein fundamentales Resultat in der linearen
            Algebra, das die Eigenschaften der <strong>Eigenwerte</strong> und <strong>Eigenvektoren</strong> einer
            symmetrischen Matrix beschreibt. Er liefert wichtige Informationen darüber, warum <strong>symmetrische
                Matrizen</strong> besonders einfach zu diagonalisierten sind, und erklärt auch, warum diese Matrizen
            <strong>orthogonal diagonalisierbar</strong> sind.
        </p>

        <h2>Spektralsatz für Symmetrische Matrizen</h2>
        <p>Der <strong>Spektralsatz</strong> besagt:</p>
        <ul>
            <li><strong>Symmetrische Matrizen</strong> (Matrizen, die gleich ihrer Transponierten sind, also \( A = A^T
                \)) besitzen immer nur <strong>reelle Eigenwerte</strong>.
            </li>
            <li>Zu einer symmetrischen Matrix existiert eine <strong>orthonormale Basis</strong> des \(\mathbb{R}^n\),
                die aus <strong>Eigenvektoren</strong> der Matrix besteht.
            </li>
            <li>Das bedeutet, dass eine symmetrische Matrix \( A \in \mathbb{R}^{n \times n} \) durch eine <strong>orthogonale
                    Matrix</strong> \( Q \) und eine <strong>Diagonalmatrix</strong> \( D \) dargestellt werden kann,
                sodass:
            </li>
        </ul>

        <div class="math-equation">
            \[
            A = Q D Q^T
            \]
        </div>

        <p>Hier ist:</p>
        <ul>
            <li>\( Q \): Eine <strong>orthogonale Matrix</strong>, deren Spalten die <strong>Eigenvektoren</strong> von
                \( A \) sind. Das bedeutet, dass \( Q^T Q = I \) gilt.
            </li>
            <li>\( D \): Eine <strong>Diagonalmatrix</strong>, die die <strong>Eigenwerte</strong> von \( A \) auf der
                Hauptdiagonale enthält.
            </li>
        </ul>

        <h2>Warum sind Symmetrische Matrizen Automatisch Orthogonal Diagonalisierbar?</h2>
        <p>
            <strong>Symmetrische Matrizen</strong> sind automatisch <strong>orthogonal diagonalisierbar</strong>, und
            das lässt sich durch die besonderen Eigenschaften der Eigenwerte und Eigenvektoren symmetrischer Matrizen
            begründen:
        </p>
        <ol>
            <li><strong>Reelle Eigenwerte</strong>:
                <ul>
                    <li>Eine symmetrische Matrix besitzt nur <strong>reelle Eigenwerte</strong>. Das bedeutet, dass alle
                        Lösungen der charakteristischen Gleichung reelle Zahlen sind.
                    </li>
                    <li>Diese Eigenschaft vereinfacht die Diagonalisierung, da komplexe Eigenwerte hier nicht auftreten,
                        wie es bei allgemeinen (nicht-symmetrischen) Matrizen möglich ist.
                    </li>
                </ul>
            </li>
            <li><strong>Orthogonale Eigenvektoren</strong>:
                <ul>
                    <li>Eine symmetrische Matrix besitzt <strong>orthogonale Eigenvektoren</strong> zu verschiedenen
                        Eigenwerten. Das bedeutet, dass die zugehörigen Eigenvektoren immer <strong>linear
                            unabhängig</strong> und zusätzlich <strong>orthogonal</strong> sind.
                    </li>
                    <li>Da die Eigenvektoren orthogonal sind, können sie zu einer <strong>orthonormalen Basis</strong>
                        normalisiert werden, wodurch die orthogonale Diagonalisierbarkeit ermöglicht wird.
                    </li>
                </ul>
            </li>
            <li><strong>Diagonalisierungsform</strong> \( A = Q D Q^T \):
                <ul>
                    <li>Die symmetrische Matrix \( A \) lässt sich durch die orthogonale Matrix \( Q \) und die
                        Diagonalmatrix \( D \) darstellen. Da \( Q \) orthogonal ist (\( Q^T = Q^{-1} \)), ergibt sich
                        die Diagonalisierungsform als:
                    </li>
                </ul>
                <div class="math-equation">
                    \[
                    A = Q D Q^T
                    \]
                </div>
                <p>Das bedeutet, dass die symmetrische Matrix durch eine orthogonale Ähnlichkeitstransformation in eine
                    <strong>Diagonalmatrix</strong> umgewandelt werden kann, was die Diagonalisierbarkeit wesentlich
                    erleichtert.</p>
            </li>
            <li><strong>Erhaltung der Struktur</strong>:
                <ul>
                    <li>Orthogonale Diagonalisierung bedeutet, dass die Diagonalisierung unter Erhaltung der Struktur
                        (Längen und Winkel) erfolgen kann. Die <strong>orthogonalen Transformationen</strong> verzerren
                        nicht die geometrische Struktur, was eine sehr stabile und nützliche Methode zur
                        Diagonalisierung darstellt.
                    </li>
                </ul>
            </li>
        </ol>

        <h2>Geometrische Bedeutung</h2>
        <p>
            Die Tatsache, dass symmetrische Matrizen orthogonal diagonalisierbar sind, hat auch eine <strong>geometrische
                Interpretation</strong>. Symmetrische Matrizen stellen oft lineare Abbildungen dar, die den Raum auf
            eine sehr geordnete Weise transformieren, wie z.B. <strong>Streckungen</strong> oder
            <strong>Schrumpfungen</strong> entlang bestimmter Achsen.
            Durch die orthogonale Diagonalisierung wird der Raum so transformiert, dass die Eigenvektoren als <strong>Hauptachsen</strong>
            dienen, entlang derer die Matrix skaliert wird (beschrieben durch die Eigenwerte).
        </p>

        <h2>Beispiel</h2>
        <p>
            Nehmen wir eine symmetrische Matrix:
        </p>
        <div class="math-equation">
            \[
            A = \begin{pmatrix} 4 & 1 \\ 1 & 3 \end{pmatrix}
            \]
        </div>
        <p>
            Die Eigenwerte dieser Matrix sind <strong>reelle Zahlen</strong>, und die zugehörigen Eigenvektoren sind
            <strong>orthogonal</strong> zueinander. Diese Matrix lässt sich orthogonal diagonalisieren:
        </p>
        <div class="math-equation">
            \[
            A = Q D Q^T
            \]
        </div>
        <p>
            wobei \( Q \) eine orthogonale Matrix ist, die die normierten Eigenvektoren als Spalten enthält, und \( D \)
            eine Diagonalmatrix ist, die die Eigenwerte enthält.
        </p>

        <h2>Zusammenfassung</h2>
        <ul>
            <li>Der <strong>Spektralsatz</strong> besagt, dass symmetrische Matrizen nur <strong>reelle
                    Eigenwerte</strong> besitzen und eine <strong>orthogonale Diagonalisierung</strong> möglich ist.
            </li>
            <li>Eine symmetrische Matrix kann immer durch eine orthogonale Matrix \( Q \) und eine Diagonalmatrix \( D
                \) dargestellt werden als \( A = Q D Q^T \).
            </li>
            <li>Symmetrische Matrizen sind automatisch <strong>orthogonal diagonalisierbar</strong>, weil ihre <strong>Eigenvektoren
                    orthogonal</strong> sind und sie <strong>reelle Eigenwerte</strong> haben.
            </li>
            <li>Die orthogonale Diagonalisierung einer symmetrischen Matrix ist besonders stabil und erhält die
                geometrische Struktur des Raumes.
            </li>
        </ul>
        <p>
            Das macht symmetrische Matrizen besonders nützlich und einfach handhabbar, sowohl in der Mathematik als auch
            in den Anwendungen, wie zum Beispiel in der <strong>Physik</strong>, der <strong>Statistik</strong> und der
            <strong>Computergraphik</strong>.
        </p>
    </div>
@endsection
