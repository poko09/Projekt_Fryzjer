class Person:
    def __init__(self,initialAge):
        # Add some more code to run some checks on initialAge
        self.initialAge = initialAge
        if(self.initialAge < 0):
            self.initialAge = 0
    def amIOld(self):
        # Do some computations in here and print out the correct statement to the console
        if(self.initialAge<0):
            self.initialAge = 0
            return ("Age is not valid")

        elif(self.initialAge<13):
            print("You are young")
        
        elif(self.initialAge >13 and self.initialAge < 18):
            print("You are a teenager")
        
        else:
            print("You are old")

    def yearPasses(self):
        # Increment the age of the person in here
        self.initialAge=self.initialAge+1

person1 = Person(-1)
print(person1.amIOld)
print(person1.yearPasses)
print(person1.initialAge)

