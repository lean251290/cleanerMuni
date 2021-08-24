# -*- coding: iso-8859-15
import sys
import os
import re

# In[13]:


def mail_format(email):
    print()
    print(f"******* funcion mail_format con parametro: {email} **********")

    if type(email) != float:
        separador = email.split('@')
        nombre = separador[0]
        print(f"parte nombre del email: {nombre}")

        if len(nombre) > 4:
            minuscula_email= email.lower()
            res = re.findall('^[a-zA-Z0-9_.+-]+@[(a-z0-9\_\-\.)]+$', str(minuscula_email.replace(' ','')))
            print(f"resultado exprecion regular: {res}")
            if res:
                print("mail_format return True")
                return True
            else:
                print("mail_format return False")
                return False

    print("mail_format return False")
    return False



def validar_dominio(dominio):
    print()
    print(f"******* funcion validar_dominio con parametro: {dominio} **********")

    dominios = ['gmail.com','gmail.com.ar','hotmail.com','turismoquovadis.com','turismoquovadis.com.ar','inta.gob.ar',
                  'hotmail.com.ar','hotmail.es','icloud.com','gigared.com','serviciosysystemas.com.ar','habitar.com.ar',
                  'serviciosysystemas.com','arnet.com.ar','iose.com.ar','invico.gov.ar','ersaurbano.com','arnet.com',
                  'yahoo.com','yahoo.com.ar','correoargentino.com','correoargentino.com.ar','comerciomb.org',
                  'outlook.com','outlook.com.ar','outlook.es','educ.ar','tasalogistica.com.ar','msn.com','ciudaddecorrientes.gov.ar',
                  'live.com','live.com.ar','live.es','ghiggeri.com','rocketmail.com','escribaniamartinez.com','osde.com.ar',
                   'agronorjc.com.ar','aiesec.net','gomezsierrayasoc.com','grupocarsa.com','jcrsa.com.ar','mcc.gob.ar',
                   'msautomotores.com.ar','previsoradelparana.com','teco.com.ar','quilmes.com.ar','taraguycienciaseconomicas.com',
                   'pami.org.ar','senasa.gov.ar','ta.telecom.com.ar','eme.com.ar','sanaroriodelnorte.com.ar',
                   'jufecsa.com.ar','expresodemonte.com','arnetbiz.com.ar','spssalud.com.ar','dazur.com.ar']
    if dominio in dominios:
        print("validar_dominio return True")
        return True
    else:
        print("validar_dominio return False")
        return False



def validar_gmail(dominio):
    print()
    print(f"******* funcion validar_gmail con parametro: {dominio} **********")

    gmail_erroneos=['gmail.con','gmail.con.ar','gnail.com','gmail.co','gnail','gmailcom','gmail','gmails.com.ar',
            'gnail.com.ar','gamil.com','gamil.com.ar','gmai.com','gmai.com.ar','gmail.com.com','gmail.comm','gmil.con',
            'hmail.com','hmail.com.ar','hgmail.com','hgmail.com','gmail','igmail.com','gmaill.com','gmeail.com.ar',
            'gmal.com','gmal.com','gmil.com','gmil.com','gmailcom','gimal.com','ymail.com','gmail.com.com.ar',
            'gemail.com','gemail.com.ar','gemeil.com','gemeil.com','gmail.comria22','gmail.es','gmail.comp','gmail..com',
            'gemil.com','gemil.com','gmeil.com','gomail.com','gamail.com','gimail.com','g.mail.com','imail.com',
            'g.mail','gamio.com','getmail','gmail.ar','gmail.comar','gmael.com.ar','gimel.com','gmaul.com',
            'gmail.comria','ghotmail.com','gmial.com','gmaio.com','gomeil.ar','gmail.vom','gtmeil.com','gmail.ocm',
            'gmx.es','gmail.xom','gmsil.com','jimeil.com','gmeil','gmey.com.ar','amail.com','gmail.om']
    if dominio in gmail_erroneos:
        print("validar_gmail return True")
        return True
    else:
        print("validar_gmail return False")
        return False



def validar_hotmail(dominio):
    print()
    print(f"******* funcion validar_hotmail con parametro: {dominio} **********")

    hotmail_erroneos=['hotmail.con','hotmail.con.ar','hotnail.com','hotmail.co','hotmaail.com','hotmai','hotmail.comar',
           'hotnail.com.ar','hotamil.com','hotamil.com.ar','hotmailcom','gotmail.com','homtail.com','hotmali.com','hotmail.com.com',
           'hotmai.com','hotmai.com.ar','hotmil.com','hotmil.com.ar','hotmail.clm','otmail.com','homail.com','hotmail.comhotmail..coc'
           'hotmal.com','hotmal.com.ar','hotmail.comcom','hotmail','hortmail.com','hitmai','htmail.com','jothmail',
            'hormail.com','hormail.com.ar','hotmailcom','hotmsil.com','hot.meil.com','htomail.com','hotail.com','holmail.com',
            'hitmail.com','hot.ail.com.ar','hotamail.com','hitmeit.com','hat.mail.com','hotmail.om','hotmail.comib',
            'hotmail.comBeldent/','hotmail.co.com','hotmaul.com','hotmaol.com','hotmaio.com','houl.com','hotmaill.com',
            'hotmal.com','hotmial.com','hotmail.vom','hotmaiil.com','hotmeil.com','hatmail.com','hotmail.ar','hoilm.com.ar']
    if dominio in hotmail_erroneos:
        print("validar_hotmail return True")
        return True
    else:
        print("validar_hotmail return True")
        return False



def validar_yahoo(dominio):
    print()
    print(f"******* funcion validar_yahoo con parametro: {dominio} **********")

    yahoo_erroneos=['yahoo.com.mx','yaju.com.ar','yahoo.fr','yahoo.es','yagoo.com','yaho.com.ar','hayoo.com','yajoo.com']

    if dominio in yahoo_erroneos:
        print("validar_yahoo return True")
        return True
    else:
        print("validar_yahoo return False")
        return False



def validar_outlook(dominio):
    print()
    print(f"******* funcion validar_outlook con parametro: {dominio} **********")

    outlook_erroneos=['outlook.cl','houtlook.com','outlookk.com','outlokk.com','outlok.com','outloo.com','outlook.com.pe',
                     'outlokk.com.ar','hutlock.s','live.com.mx','live.com.atletismo1','live.com.com.ar','outloik.com',
                     'oultlook.com','outlok.es','oglok.com','outloock.es','oulook.com','uotlook.com.ar','autlod.es',
                     'uotlook.com.ar','autlok.com','putlook.com','outlook.es.com','outlook','outlook.ar','outlook.live.com']

    if dominio in outlook_erroneos:
        print("return validar_outlook True")
        return True
    else:
        print("return validar_outlook False")
        return False




def separar_email (data_email):
    print()
    print(f"******* funcion separar_email con parametro: {data_email} **********")

    espacios_blanco = data_email.replace(' ','')
    separador=espacios_blanco.lower()
    separador = separador.split('@')
    print(f"******* email sin espacios y separado: {separador} **********")
    return separador



def validador_email (data_email):
    print()
    print("************* funcion principal *******************")
    print(f"******* funcion validador_email con parametro: {data_email} **********")

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

        print(f"servidor: {servidor}")
        print(f"email_nuevo: {email_nuevo}")
        print(f"cadena_sinNum: {cadena_sinNum}")

        if validar_dominio(servidor):
            email_nuevo.append(separado2)
            email_nuevo.append(servidor)
            email_editado = "@".join(email_nuevo)
            print(f"email_editado: {email_editado}")
            return email_editado

        elif validar_gmail(servidor):
            email_nuevo.append(separado2)
            email_nuevo.append('gmail.com')
            email_editado = "@".join(email_nuevo)
            print(f"email_editado: {email_editado}")
            return email_editado

        elif validar_hotmail(servidor):
            email_nuevo.append(separado2)
            email_nuevo.append('hotmail.com')
            email_editado = "@".join(email_nuevo)
            print(f"email_editado: {email_editado}")
            return email_editado

        elif validar_yahoo(servidor):
            email_nuevo.append(separado2)
            email_nuevo.append('yahoo.com')
            email_editado = "@".join(email_nuevo)
            print(f"email_editado: {email_editado}")
            return email_editado

        elif validar_outlook(servidor):
            email_nuevo.append(separado2)
            email_nuevo.append('outlook.com')
            email_editado = "@".join(email_nuevo)
            print(f"email_editado: {email_editado}")
            return email_editado
        else:
            return ''
    else:
        print("formato email no valido!")
        return ''


# In[15]:

num_args = len(sys.argv)

if num_args >= 2:
    email = validador_email(sys.argv[1])
    print(email)
else:
    print(f"{num_args} es menor a 2")