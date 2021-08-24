# -*- coding: iso-8859-15
import sys
import os
import re

# In[13]:


def mail_format(email):
    if type(email) != float:
        separador = email.split('@')
        nombre = separador[0]
        if len(nombre) > 4:
            minuscula_email= email.lower()

            if re.findall('^[a-zA-Z0-9_.+-]+@[(a-z0-9\_\-\.)]+$', str(minuscula_email.replace(' ',''))):
                return True
            else:
                return False
    return False

def validar_dominio(dominio):
    dominios = ['gmail.com','gmail.com.ar','hotmail.com','turismoquovadis.com','turismoquovadis.com.ar','inta.gob.ar','dpec.com.ar',
                  'hotmail.com.ar','hotmail.es','icloud.com','gigared.com','serviciosysystemas.com.ar','habitar.com.ar','ayalaautomotoressa.com.ar',
                  'serviciosysystemas.com','arnet.com.ar','iose.com.ar','invico.gov.ar','ersaurbano.com','arnet.com','colegioyapeyu.edu.ar',
                  'yahoo.com','yahoo.com.ar','correoargentino.com','correoargentino.com.ar','comerciomb.org','ucp.edu.ar','conicet.gov.ar',
                  'outlook.com','outlook.com.ar','outlook.es','educ.ar','tasalogistica.com.ar','msn.com','ciudaddecorrientes.gov.ar','unoinformatica.com.ar',
                  'live.com','live.com.ar','live.es','ghiggeri.com','rocketmail.com','escribaniamartinez.com','osde.com.ar','13maxtv.com',
                   'agronorjc.com.ar','aiesec.net','gomezsierrayasoc.com','grupocarsa.com','jcrsa.com.ar','mcc.gob.ar','aguasdecorrientes.com',
                   'msautomotores.com.ar','previsoradelparana.com','teco.com.ar','quilmes.com.ar','taraguycienciaseconomicas.com','casinosdellitoral.com.ar',
                   'pami.org.ar','senasa.gov.ar','ta.telecom.com.ar','eme.com.ar','sanaroriodelnorte.com.ar','gigared.com.ar','ciudad.com.ar',
                   'jufecsa.com.ar','expresodemonte.com','arnetbiz.com.ar','spssalud.com.ar','dazur.com.ar','educacionadventista.org.ar','funcacorr.org.ar',
                   'odn.unne.edu.ar','lxargentina.com.ar','shonko.com','cetrogar.com.ar','afip.gob.ar','tipoiti.com','exa.unne.edu.ar','vet.unne.edu.ar',
                   'thebetsyhotel.com','delatrinidad.com.ar','ius.austral.edu.ar','fibertel.com.ar','savonaviajes.com','hipotecario.com.ar','drogueria-avenida.com.ar',
                   'credicompras.com.ar','med.unne.edu.ar','comunidad.unne.edu.ar']
    if dominio in dominios:
        return True
    else:
        return False

def validar_gmail(dominio):
    gmail_erroneos=['gmail.con','gmail.con.ar','gnail.com','gmail.co','gnail','gmailcom','gmail','gmails.com.ar',
            'gnail.com.ar','gamil.com','gamil.com.ar','gmai.com','gmai.com.ar','gmail.com.com','gmail.comm','gmil.con',
            'hmail.com','hmail.com.ar','hgmail.com','hgmail.com','gmail','igmail.com','gmaill.com','gmeail.com.ar','gmail.com.',
            'gmal.com','gmal.com','gmil.com','gmil.com','gmailcom','gimal.com','ymail.com','gmail.com.com.ar','gomeil.com',
            'gemail.com','gemail.com.ar','gemeil.com','gemeil.com','gmail.comria22','gmail.es','gmail.comp','gmail..com','gimeil.com',
            'gemil.com','gemil.com','gmeil.com','gomail.com','gamail.com','gimail.com','g.mail.com','imail.com','g-mail.com','gmail,com',
            'g.mail','gamio.com','getmail','gmail.ar','gmail.comar','gmael.com.ar','gimel.com','gmaul.com','himail.com','hitmeil.com',
            'gmail.comria','ghotmail.com','gmial.com','gmaio.com','gomeil.ar','gmail.vom','gtmeil.com','gmail.ocm','gmailll.com','gmial..com',
            'gmx.es','gmail.xom','gmsil.com','jimeil.com','gmeil','gmey.com.ar','amail.com','gmail.om','gimeil..com','gtmail.com','gmail,com',
            'gmail.coml','gmail.gom','jimail.com','@gmail.com','gmail.comcom','gmail,com','jitmail .com','gailmeil','gmail.clm','ganil.com'
            ,'gma.com','gmail.comq','gmi.com','gmall.com','googlemail.com','gmail.como','gotmey.com']
    if dominio in gmail_erroneos:
        return True
    else:
        return False

def validar_hotmail(dominio):
    hotmail_erroneos=['hotmail.con','hotmail.con.ar','hotnail.com','hotmail.co','hotmaail.com','hotmai','hotmail.comar','hptmail.com',
           'hotnail.com.ar','hotamil.com','hotamil.com.ar','hotmailcom','gotmail.com','homtail.com','hotmali.com','hotmail.com.com',
           'hotmai.com','hotmai.com.ar','hotmil.com','hotmil.com.ar','hotmail.clm','otmail.com','homail.com','hotmail.comhotmail..coc'
           'hotmal.com','hotmal.com.ar','hotmail.comcom','hotmail','hortmail.com','hitmai','htmail.com','jothmail','hotmail.comhotmail..coc',
            'hormail.com','hormail.com.ar','hotmailcom','hotmsil.com','hot.meil.com','htomail.com','hotail.com','holmail.com','hotmail.gom',
            'hitmail.com','hot.ail.com.ar','hotamail.com','hitmeit.com','hat.mail.com','hotmail.om','hotmail.comib','hotmail.com.are',
            'hotmail.comBeldent/','hotmail.co.com','hotmaul.com','hotmaol.com','hotmaio.com','houl.com','hotmaill.com','hotmail..com',
            'hotmal.com','hotmial.com','hotmail.vom','hotmaiil.com','hotmeil.com','hatmail.com','hotmail.ar','hoilm.com.ar','hotmail.it','jotmail.com',
            'hotmail.cpm','hotmail.com_','hotmail,com','hotmi.com.ar','hotmail.comm','hotmail.localdomain','hotmal.es','hoymail.con','hemail.com',
            'hotymail.com','hotmaim.com','hoymail.com','hotmail.copm','hotmail.col','homtmail.com','hotmaik.com','hotmailcom.ar','hotmail.com.at',
            'hmail.vom']
    if dominio in hotmail_erroneos:
        return True
    else:
        return False

def validar_yahoo(dominio):
    yahoo_erroneos=['yahoo.com.mx','yaju.com.ar','yahoo.fr','yahoo.es','yagoo.com','yaho.com.ar','hayoo.com','yajoo.com',
                        'yohoo.com.ar','yahoo.com.a','yahho.com.ar','yagoo.com.ar','yahoo.com.arar','yahoo.com.','yahooo.com.ar'
                        ,'uahoo.com.ar','yahoomail.com.ar','yawoo.comar']

    if dominio in yahoo_erroneos:
        return True
    else:
        return False

def validar_outlook(dominio):
    outlook_erroneos=['outlook.cl','houtlook.com','outlookk.com','outlokk.com','outlok.com','outloo.com','outlook.com.pe','outrok.com',
                     'outlokk.com.ar','hutlock.s','live.com.mx','live.com.atletismo1','live.com.com.ar','outloik.com','oulook.com.ar',
                     'oultlook.com','outlok.es','oglok.com','outloock.es','oulook.com','uotlook.com.ar','autlod.es','outlook.co','live.com>'
                     'uotlook.com.ar','autlok.com','putlook.com','outlook.es.com','outlook','outlook.ar','outlook.live.com','putlook.es','outluk.com'
                     ,'ourlook.com','live.cl','outlook.clm','outlook.com.comar','otblook.com']

    if dominio in outlook_erroneos:
        return True
    else:
        return False

def separar_email (data_email):
    espacios_blanco = data_email.replace(' ','')
    separador=espacios_blanco.lower()
    separador = separador.split('@')
    return separador

def validador_email (data_email):
    servidor_valido =[]
    if mail_format(data_email):
        separador = separar_email(data_email)
        separado  = separador[1]
        separado2 = separador[0]
        cadena_sinNum  =[]
        email_nuevo = []
        for letra in separado:
            if letra.isdigit() != True:
                cadena_sinNum.append(letra)
                servidor = "".join(cadena_sinNum)

        if validar_dominio(servidor):
            email_nuevo.append(separado2)
            email_nuevo.append(servidor)
            email_editado = "@".join(email_nuevo)
            return email_editado

        elif validar_gmail(servidor):
            email_nuevo.append(separado2)
            email_nuevo.append('gmail.com')
            email_editado = "@".join(email_nuevo)
            return email_editado

        elif validar_hotmail(servidor):
            email_nuevo.append(separado2)
            email_nuevo.append('hotmail.com')
            email_editado = "@".join(email_nuevo)
            return email_editado

        elif validar_yahoo(servidor):
            email_nuevo.append(separado2)
            email_nuevo.append('yahoo.com')
            email_editado = "@".join(email_nuevo)
            return email_editado

        elif validar_outlook(servidor):
            email_nuevo.append(separado2)
            email_nuevo.append('outlook.com')
            email_editado = "@".join(email_nuevo)
            return email_editado
        else:
            return ''
    else:
        #MODIFIQUE ACA PARA VER X DONDE PASA SI NO VALIDA
        return 'entra x aca'


# In[15]:


if len(sys.argv) >= 2:
 email = validador_email(sys.argv[1])
 print(email)
else:
 print ("")