<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService implements EmailServiceInterface
{
    private PHPMailer $mailer;

    /**
     * @throws Exception
     */
    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;

        // Configurer PHPMailer pour utiliser un serveur SMTP
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['SMTP_HOST'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['SMTP_USERNAME'];
        $this->mailer->Password = $_ENV['SMTP_PASSWORD'];
        $this->mailer->SMTPSecure = $_ENV['SMTP_SECURE'];
        $this->mailer->Port = $_ENV['SMTP_PORT'];

        // Configurations facultatives
        $this->mailer->setFrom($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']);
    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function sendEmail(string $to, string $subject, string $body): void
    {
        $this->mailer->clearAddresses(); // Effacer les anciennes adresses
        $this->mailer->addAddress($to);  // Ajouter le destinataire
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;
        $this->mailer->isHTML(true);  // Envoyer le corps du message en HTML

        if (!$this->mailer->send()) {
            throw new \Exception('Erreur d\'envoi de l\'email: ' . $this->mailer->ErrorInfo);
        }
    }
}
