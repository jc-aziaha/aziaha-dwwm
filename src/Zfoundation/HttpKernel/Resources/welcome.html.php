<!DOCTYPE html>
<html dir="ltr" lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>dwwm framework &#x1F642;</title>
        <style>
            body
            {
                background-color: #f8f9fa;
            }

            h1
            {
                text-align: center;
                margin-bottom: 2rem;
                text-shadow: 5px 5px 20px rgba(0, 0, 0, .2);
            }

            /* .heading-line::before
            {
                content: "";
                width: 8rem;
                height: .2rem;
                display: block;
                margin: 0 auto;
                background-color: red;
            } */

            .heading-line::after
            {
                content: "";
                width: 8rem;
                height: .2rem;
                display: block;
                margin: .5rem auto;
                background-color: rgba(0, 0, 0, .5);
                padding-top: .2rem;
            }

            section
            {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                /* text-align: center; */
                margin: 1rem auto;
                
            }
            
            
            section div
            {
                background-color: white;
                box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
                width: 90%;
                padding: 1rem;
                transition: 1s;
            }
            
            section div:hover
            {
                transition: 1s;
                transform: scale(1.03);
            }

            @media screen and (min-width: 768px)
            {
                section div
                {
                    width: 70%;
                }
            }

            

        </style>
    </head>
    <body>
        <h1 class="heading-line">Bonjour les dwwm &#x1F642;</h1>

        <section>
            <div>
                <p>Je vous souhaite la bienvenue dans cette formation dans laquelle nous allons créer notre propre cadre de travail (framework).</p>
                <p>Ce framework n'est pas à but commercial mais plutôt à but d'apprentissage.</p>
                <p>En effet, notre objectif est de mettre en pratique les concepts de la programmation orientée objet en php.</p>
            </div>
        </section>

        <section>
            <div>
                <p>Les rôles du framework : </p>
                <ul>
                    <li>Recevoir la requête d'un client</li>
                    <li>La traiter</li>
                    <li>Lui retourner la réponse correspondante</li>
                </ul>
            </div>
        </section>
        
        <section>
            <div>
                <p>Au fait, si vous voyez cette page, c'est que vous n'avez pas encore créé votre propre page d'accueil.</p>
                <p>Pour le faire, veuillez <a target="_blank" href="https://github.com/jc-aziaha/dwwm_poo_framework.git">consulter la documentation</a>.</p>
            </div>
        </section>

        <!-- <section>
            <div>
                <p>Je vous souhaite la bienvenue dans cette formation dans laquelle nous allons créer notre propre cadre de travail (framework).</p>
        
                <p>Ce framework n'est pas à but commercial mais plutôt à but d'apprentissage.</p>
            </div>
            <div>
                <p>En effet, notre objectif est de mettre en pratique les concepts de la programmation orientée objet en php</p>
        
                <p>Si vous voyez cette page, c'est que vous n'avez pas encore créé votre propre page d'accueil</p>
            </div>
        </section> -->




    </body>
</html>